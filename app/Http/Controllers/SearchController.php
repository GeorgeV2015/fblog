<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public function index()
    {
        $search = strip_tags(request('search'));
        if (preg_replace('/\W/', '', $search) == '') {
            return back();
        }

        $posts = Post::with('category', 'author')->published()->ordered()->searchFilter($search);
        $title = 'Search results: (' . $posts->count() . ')';
        $posts = $posts->paginate(6);
        $posts->withPath('/search?search=' . $search);

        return view('home', compact('posts', 'title'));
    }
}
