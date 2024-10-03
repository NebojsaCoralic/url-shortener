@extends('adminlte::page')

@section('content')
    <h1>Create Shortened URL</h1>

    <form action="{{ route('urls.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="url">Original URL</label>
            <input type="text" name="url" id="url" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="expires_at">Expiration Date</label>
            <input type="datetime-local" name="expires_at" id="expires_at" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="is_secure">Secure URL</label>
            <input type="checkbox" name="is_secure" id="is_secure" value="1">
        </div>

        <button type="submit" class="btn btn-primary">Create Shortened URL</button>
    </form>
@endsection
