<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): Renderable
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create(): Renderable
    {
        $companies = Company::all();
        return view('users.create', compact('companies'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $params = $request -> validated();
        $params['password'] = Hash::make($params['password']);
        (new User()) -> create($params);

        return redirect() -> route('users.index');
    }

    public function edit(User $user): Renderable
    {
        $companies = Company::all();
        return view('users.edit', compact('user', 'companies'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $params = $request -> validated();

        if(!$params['password'])
            unset($params['password']);
        else
            $params['password'] = Hash::make($params['password']);
        $params['password'] =
        $user->update($params);
        return redirect() -> route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user -> delete();
        return redirect() -> route('users.index');
    }
}
