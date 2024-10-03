@extends('adminlte::page')

@section('content')
    <h1>Edit Shortened URL</h1>

    <form action="{{ route('urls.update', $url->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="url">Original URL</label>
            <input type="text" name="url" id="url" class="form-control" value="{{ $url->url }}">
        </div>

        <div class="form-group">
            <label for="is_secure">Secure URL</label>
            <input type="checkbox" name="is_secure" id="is_secure" value="1" {{ $url->is_secure ? 'checked' : '' }}>
        </div>

        <button type="submit" class="btn btn-primary">Update Shortened URL</button>
    </form>
@endsection
