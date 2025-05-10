<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(
        private UserServiceInterface $userService
    ) {}

    public function index(Request $request): Response
    {
        $cities = [];
        if ($request->input('country')) {
            $cities = $this->userService->getCitiesByCountry($request->input('country'));
        }

        return Inertia::render('Users/Index', [
            'users' => $this->userService->getFilteredUsers($request),
            'filters' => $request->only(['search', 'country', 'sort', 'order', 'per_page', 'city']),
            'countries' => $this->userService->getAvailableCountries(),
            'cities' => $cities,
        ]);
    }

    public function show(User $user): Response
    {
        return Inertia::render('Users/Show', [
            'user' => $user->load('address'),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userService->createUser($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', [
            'user' => $user->load('address'),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->userService->updateUser($user, $request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

}

