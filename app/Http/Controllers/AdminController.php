<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'userCount' => User::count(),
            'postCount' => Post::count(),
            'commentCount' => Comment::count(),
        ]);
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function posts()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('admin.posts', compact('posts'));
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted.');
    }

    public function comments()
    {
        $comments = Comment::with('user', 'post')->latest()->paginate(10);
        return view('admin.comments', compact('comments'));
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }
}
