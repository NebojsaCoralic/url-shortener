@extends('adminlte::page')

@section('content')
    <h1>Companies</h1>
    <a href="{{ route('companies.create') }}" class="btn btn-primary">Create New Company</a>

    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->name }}</td>
                <td>
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
