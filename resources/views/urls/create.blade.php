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
            <label for="is_secure">Secure URL</label>
            <select name="is_secure" class="form-control">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Shortened URL</button>
    </form>
@endsection
