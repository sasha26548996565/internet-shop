<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): View
    {
        $users = User::latest()->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->userService->store($request->validated());

        return to_route('admin.user.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return to_route('admin.user.index');
    }
}
