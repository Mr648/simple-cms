<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:comment')->only('store');
    }

    public function store(Request $request)
    {
        $this->check($request); // validation

        $comment = new Comment([
            'comment' => $request->input('comment')
        ]);
        $comment->user()->associate($request->user());
        $post = Post::find($request->input('post_id'));
        $post->comments()->save($comment);

        return redirect()->back();
    }

    public function reply(Request $request)
    {

        $this->check($request); // validation

        $reply = new Comment();

        $reply->comment = $request->input('comment');
        $reply->user()->associate($request->user());

        $reply->parent_id = $request->input('comment_id');

        $post = Post::find($request->input('post_id'));
        $post->comments()->save($reply);

        return redirect()->back();
    }

    public function check(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
            'comment' => 'required|string|max:250'
        ]);
    }
}
