<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public function index()
    {
        $posts = Post::with('category', 'author')->published()->ordered()->searchFilter(\request('search'));
        $title = 'Search results: (' . $posts->count() . ')';
        $posts = $posts->paginate(6);
        $posts->withPath('/search?search=' . \request('search'));

        return view('home', compact('posts', 'title'));
    }
}
