<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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
            'title' => 'required'
        ]);
        $tag = Tag::create($request->all());
        $tag->setStatus($request->get('published'));

        return redirect()->route('tags.index')->with('status', "Tag '$tag->title' has been created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        return view('admin.tags.edit', compact('tag'));
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
            'title' => 'required'
        ]);
        $tag = Tag::where('slug', $slug)->first();
        $tag->update($request->all());
        $tag->setStatus($request->get('published'));

        return redirect()->route('tags.index')->with('status', "Tag '$tag->title' has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        $tagName = $tag->title;
        $tag->delete();

        return redirect()->route('tags.index')->with('status', "Tag '$tag->title' has been deleted");
    }

    // Переключатель статуса тэга published
    public function toggle($slug)
    {
        Tag::where('slug', $slug)->first()->toggleStatus();

        return redirect()->back()->with('status', 'Tag status has been changed');
    }
}
