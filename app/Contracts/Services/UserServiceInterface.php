<?php

namespace App\Contracts\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function getFilteredUsers(Request $request): LengthAwarePaginator;
    public function getAvailableCountries(): array;
    public function createUser(array $validated): User;
    public function updateUser(User $user, array $validated): void;
    public function getCitiesByCountry(string $country): array;
}
