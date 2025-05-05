@extends('layouts.app')

@section('title', 'Manage Posts')

@section('content')
    <h1>All Posts</h1>
    <ul>
        @foreach($posts as $post)
            <li>
                {{ $post->title }} by {{ $post->user->name }}

                <form action="{{ route('admin.posts.delete', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    {{ $posts->links() }}
@endsection
