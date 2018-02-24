<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Page;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $unpublishedComments = Comment::where('published', false)->count();
        $unpublishedPosts = Post::where('published', false)->count();
        $bannedUsers = User::where('banned_at', '<>', null)->count();
        $inactivePages = Page::where('published', false)->count();

        return view('admin.dashboard', compact('unpublishedComments', 'unpublishedPosts', 'bannedUsers', 'inactivePages'));
    }
}
