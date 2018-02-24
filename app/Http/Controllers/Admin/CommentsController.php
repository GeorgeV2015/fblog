<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post', 'user')->get();

        return view('admin.comments.index', compact('comments'));
    }

    public function toggleStatus($id)
    {
        $comment = Comment::find($id);
        $comment->toggleStatus();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Comment::find($id)->delete();

        return redirect()->back();
    }
}
