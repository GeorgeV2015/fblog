<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'author')->published()->ordered()->dataFilter(\request(['month', 'year']))->paginate(6);

        if(\request('month') || \request('year'))
        {
            $posts->withPath('/?month=' . \request('month') . '&year=' . \request('year'));
        }

        $title = 'FBlog Homepage';

        return view('home', compact('posts', 'title'));
    }

    public function show($categorySlug, $postSlug)
    {
        $post = Post::with([
            'category' => function($query) use ($categorySlug) {
                $query->where('published', true)->where('slug', $categorySlug);//->firstOrFail();
            },
            'author'])
            ->published()
            ->where('slug', $postSlug)
            ->firstOrFail();

        $comments = $post->comments()->with('user')->published()->get();

        $postNavigation = [
            'previous' => $post->getPrevious(),
            'next' => $post->getNext()
        ];

        $post->addView();

        return view('pages.show', compact('post', 'comments', 'postNavigation'));
    }

    public function tag($slug)
    {
        $tag = Tag::published()->where('slug', $slug)->firstOrFail();
        $title = 'Tag: "' . $tag->title . '"';
        $posts = $tag->posts()->with('category', 'author')->published()->ordered()->paginate(6);

        return view('home', compact('tag', 'title', 'posts'));
    }

    public function category($slug)
    {
        $category = Category::published()->where('slug', $slug)->firstOrFail();
        $title = 'Category: "' . $category->title . '"';
        $posts = $category->posts()->with('category', 'author')->published()->ordered()->paginate(6);

        return view('home', compact('category', 'title', 'posts'));
    }
}
