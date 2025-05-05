@extends('layouts.app')
@section('title', $post->title)
@section('content')
    <article class="mb-5">
        <h1>{{ $post->title }}</h1>
        <p class="text-muted">
            By {{ $post->user->name }} on {{ $post->created_at->format('d.m.Y') }}
        </p>
        @if(auth()->id() === $post->user_id)
            <div class="mb-3">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Wirklich löschen?')">Delete</button>
                </form>
            </div>
        @endif
        <div class="py-3">
            {{ $post->content }}
        </div>
    </article>
    <hr>
    <section class="comments mt-5">
        <h3>Comments ({{ $post->comments->count() }})</h3>
        @foreach($post->comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{{ $comment->content }}</p>
                    <footer class="text-muted small">
                        {{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}
                    </footer>
                </div>
            </div>
        @endforeach
        @auth
            <div class="mt-4">
                <h4>New Comment</h4>
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <textarea name="content" rows="3" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        @else
            <p class="mt-4">
                <a href="{{ route('login') }}">Log in</a>, to write a comment.
            </p>
        @endauth
    </section>
@endsection
