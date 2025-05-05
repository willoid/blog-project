@extends('layouts.app')
@section('title', 'Create Post')
@section('content')
    <h1>Create a New Post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" rows="5" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
@endsection
