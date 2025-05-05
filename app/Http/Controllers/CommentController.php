<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) {
        $validateData = $request->validate([
            'content' => 'required',
        ]);

        $post->comments()->create([
            'content' => $validateData['content'],
            'user_id' => $request->user()->id,
        ]);

        return back()->with('success', 'Comment added successfully');
    }
}


//to do
// public function edit(Comment $comment){}
// public function update(Request $request, Comment $comment){}
// public function destroy(Comment $comment){}
