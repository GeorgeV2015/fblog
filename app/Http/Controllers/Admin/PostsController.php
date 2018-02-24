<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'tags')->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::published()->pluck('title', 'id')->all();
        $tags = Tag::published()->pluck('title', 'id')->all();

        return view('admin.posts.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required',
            'content'     => 'required',
            'publishDate' => 'required',
            'category_id' => 'required',
            'image'       => 'nullable|image|max:1500'
        ]);
        $post = Post::add($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->setStatus($request->get('published'));
        $post->setFeatured($request->get('is_featured'));

        return redirect()->route('posts.index')->with('status', "Post '$post->title' has been created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::with('category')->where('slug', $slug)->first();
        $categories = Category::published()->pluck('title', 'id')->all();
        $tags = Tag::published()->pluck('title', 'id')->all();
        $selectedTags = $post->tags->pluck('id')->all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'title'       => 'required',
            'content'     => 'required',
            'publishDate' => 'required',
            'category_id' => 'required',
            'image'       => 'nullable|image|max:1500'
        ]);
        $post = Post::where('slug', $slug)->first();
        $post->edit($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->setStatus($request->get('published'));
        $post->setFeatured($request->get('is_featured'));

        return redirect()->route('posts.index')->with('status', "Post '$post->title' has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $postTitle = $post->title;
        $post->remove();

        return redirect()->back()->with('status', "Post '$postTitle' has been deleted");
    }

    public function toggle($slug)
    {
        Post::where('slug', $slug)->first()->toggleStatus();

        return redirect()->back()->with('status', 'Post status has been changed');
    }

    public function toggleFeatured($slug)
    {
        Post::where('slug', $slug)->first()->toggleFeatured();

        return redirect()->back()->with('status', 'Post status has been changed');
    }

}
