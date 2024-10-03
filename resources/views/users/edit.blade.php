@extends('adminlte::page')

@section('content')
    <h1>Edit User</h1>
{{ var_dump($errors -> all()) }}
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="is_admin">Admin</label>
            <select class="form-control" name="is_admin">
                <option value="0" {{ $user -> is_admin ? '' : 'selected' }}>No</option><option value="1" {{ $user -> is_admin ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password (Leave blank to keep current password)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
@endsection
