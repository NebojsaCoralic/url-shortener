<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): Renderable
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create(): Renderable
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        (new User()) -> create($request -> validated());

        return redirect() -> route('users.index');
    }

    public function edit(User $user): Renderable
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $params = $request -> validated();

        if(!$params['password'])
            unset($params['password']);

        $user->update($params);
        return redirect() -> route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user -> delete();
        return redirect() -> route('users.index');
    }
}
