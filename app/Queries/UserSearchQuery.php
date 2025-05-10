<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserSearchQuery
{
    private Request $request;
    private Builder $query;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = User::query();
    }

    public function handle(): Builder
    {
        return $this->query
            ->with('address')
            ->when(
                $this->request->input('search'),
                fn (Builder $query, string $search) => $this->applySearchFilter($query, $search)
            )
            ->when(
                $this->request->input('country'),
                fn (Builder $query, string $country) => $this->applyCountryFilter($query, $country)
            )
            ->when(
                $this->request->input('sort'),
                fn (Builder $query, string $sortBy) => $this->applySorting($query, $sortBy)
            );
    }

    private function applySearchFilter(Builder $query, string $search): Builder
    {
        $searchTerms = explode(' ', $search);

        return $query->where(function (Builder $q) use ($searchTerms) {
            foreach ($searchTerms as $term) {
                $q->where(function (Builder $subQuery) use ($term) {
                    $subQuery->where('first_name', 'like', "%{$term}%")
                        ->orWhere('last_name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%");

                        // Better Search But Deacreases Performance
                        // ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$term}%"])
                        // ->orWhereHas('address', function(Builder $addressQuery) use ($term) {
                        //     $addressQuery->where('city', 'like', "%{$term}%")
                        //         ->orWhere('country', 'like', "%{$term}%");
                        // });
                });
            }
        });
    }

    private function applyCountryFilter(Builder $query, string $country): Builder
    {
        $query = $query->whereHas('address', fn (Builder $q) => $q->where('country', $country));

        if ($city = $this->request->input('city')) {
            $query->whereHas('address', fn (Builder $q) => $q->where('city', $city));
        }

        return $query;
    }

    private function applySorting(Builder $query, string $sortBy): Builder
    {
        $order = $this->request->input('order', 'desc');

        if ($sortBy === 'name') {
            return $query->orderBy('first_name', $order)->orderBy('last_name', $order);
        }

        return $query->orderBy($sortBy, $order);
    }
}
