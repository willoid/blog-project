<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class PostController extends Controller
{
    public function index(){

        //$posts = Post::with('user', 'comments')->latest()->paginate(10);
        $posts = Post::with('user')->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }
    public function show(Post $post){
        $post->load('user', 'comments.user');
        return view('posts.show', compact('post'));
    }
    public function create(){
        return view('posts.create');
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $post = $request->user()->posts()->create($validateData);

        return redirect()->route('posts.show', $post)->with('success', 'Post created successfully');
    }
    public function edit(Post $post){

        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));

    }
    public function update(Request $request, Post $post){
        $this->authorize('update', $post);

        $validateData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($validateData);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully');
    }
    public function destroy(Post $post){
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}

