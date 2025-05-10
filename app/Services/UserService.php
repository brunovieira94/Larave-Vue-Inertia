<?php

namespace App\Services;

use App\Contracts\Services\UserServiceInterface;
use App\Models\User;
use App\Queries\UserSearchQuery;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class UserService implements UserServiceInterface
{
    public function getFilteredUsers(Request $request): LengthAwarePaginator
    {
        $perPage = $request->input('per_page', 10);

        return (new UserSearchQuery($request))
            ->handle()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function getAvailableCountries(): array
    {
        return Cache::remember(
            'available_countries',
            config('cache-ttl.ttl.countries'),
            function () {
                return User::join('addresses', 'users.id', '=', 'addresses.user_id')
                    ->select('addresses.country')
                    ->distinct()
                    ->pluck('country')
                    ->sort()
                    ->values()
                    ->toArray();
            }
        );
    }

    public function getCitiesByCountry(string $country): array
    {
        return Cache::remember(
            "cities_by_country_{$country}",
            config('cache-ttl.ttl.cities'),
            function () use ($country) {
                return User::join('addresses', 'users.id', '=', 'addresses.user_id')
                    ->where('addresses.country', $country)
                    ->select('addresses.city')
                    ->distinct()
                    ->pluck('city')
                    ->sort()
                    ->values()
                    ->toArray();
            }
        );
    }

    public function createUser(array $validated): User
    {
        $user = User::create($validated);
        $user->address()->create($validated['address']);

        return $user;
    }

    public function updateUser(User $user, array $validated): void
    {
        $user->update($validated);
        $user->address->update($validated['address']);
    }
}
