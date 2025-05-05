<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Blog Space')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Welcome to the Blog Space</a>

        <div class="d-flex align-items-center gap-2 ms-auto">
            @auth
                <span class="text-white me-2">Hello, {{ Auth::user()->name }}</span>

                <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success">New Post</a>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Login</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-success">Register</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
