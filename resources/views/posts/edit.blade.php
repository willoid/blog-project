@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')
    <article class="mb-5">
        <h1>{{ $post->title }}</h1>
        <p class="text-muted">
            By {{ $post->user->name }} on {{ $post->created_at->format('d.m.Y') }}
        </p>
        @if(auth()->id() === $post->user_id)
            <div class="mb-3">
                <form action="{{ route('posts.update', $post) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <textarea name="content" rows="3" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-danger">Update</button>
                </form>
            </div>
        @endif

    </article>
@endsection

@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="mb-5">
        <h1>Edit Post</h1>

        @if(auth()->id() === $post->user_id)
            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $post->title) }}"
                        required
                    >
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="content">Content</label>
                    <textarea
                        name="content"
                        id="content"
                        rows="5"
                        class="form-control @error('content') is-invalid @enderror"
                        required
                    >{{ old('content', $post->content) }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        @else
            <p class="text-danger">You are not authorized to edit this post.</p>
        @endif
    </article>
@endsection

