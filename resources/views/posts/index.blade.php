@extends('layouts.app')
@section('title', 'Alle Posts')
@section('content')
    <h1>All blog posts</h1>
    @foreach($posts as $post)
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <p class="text-muted">
                    By {{ $post->user->name }} on {{ $post->created_at->format('d.m.Y') }}
                </p>
                <p class="card-text">{{ Str::limit($post->content, 200) }}</p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">
                    Read more
                </a>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}
@endsection
