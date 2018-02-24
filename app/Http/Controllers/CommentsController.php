<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
            'post_id' => 'required'
        ]);
        $comment = new Comment();
        $comment->text = $request->get('text');
        $comment->post_id = $request->get('post_id');
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return redirect()->back()->with('status', 'Your comment will be added soon');
    }
}
