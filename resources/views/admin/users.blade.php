@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
    <h1 class="mb-4">All Registered Users</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Registered</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d.m.Y') }}</td>
                <td>
                    @if(auth()->id() !== $user->id)
                        <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @else
                        <em>(You)</em>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No users found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
