@extends('adminlte::page')

@section('content')
    <h1>Shortened URLs</h1>

    <a href="{{ route('urls.create') }}" class="btn btn-primary">Create New URL</a>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Original URL</th>
            <th>Short URL</th>
            <th>Expiration Date</th>
            <th>Expired</th>
            <th>Click Count</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($urls as $url)
            <tr>
                <td>{{ $url->id }}</td>
                <td><a href="{{ $url->url }}" target="_blank">{{ $url->url }}</a></td>
                <td><a href="{{ route('urls.redirect', $url->short_url) }}" target="_blank">{{ route('urls.redirect', $url->short_url) }}</a></td>
                <td>{{ $url->expires_at }}</td>
                <td>{{ $url -> is_expired ? 'Yes' : 'No' }}</td>
                <td>{{ $url->count }}</td>
                <td>
                    @if(auth() -> user() -> is_admin || auth() -> user() -> id == $url->user_id)
                        <a href="{{ route('urls.edit', $url->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('urls.destroy', $url->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @if(!$url -> is_expired)
                            <form action="{{ route('urls.extend-expiry', $url) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">+ 7 days</button>
                            </form>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
