<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PagesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        //dd($pages[1]);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->get('type');
        $page_id = $request->get('page_id');

        return view('admin.pages.create', compact('type', 'page_id'));
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
            'title'     => 'required',
            'content'   => 'nullable',
            'parent_id' => "nullable",
            'type'      => Rule::in(['page', 'strElement', 'textElement'])
        ]);

        $page = Page::create($request->all());

        return redirect()->route('pages.index')->with('status', "Page '$page->title' has been created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $pages = Page::isPage()->pluck('title', 'id')->all();

        return view('admin.pages.edit', compact('page', 'pages'));
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
        //dd($request->all());
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'nullable',
            'parent_id' => 'nullable',
            'type'      => Rule::in(['page', 'strElement', 'textElement'])
        ]);

        $page = Page::where('slug', $slug)->first();
        $page->update($request->all());
        $page->setStatus($request->get('published'));

        return redirect()->route('pages.index')->with('status', "Page '$page->title' has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $pageTitle = $page->title;
        $page->delete();

        return redirect()->back()->with('status', "Page '$pageTitle' has been deleted");
    }

    public function toggle($slug)
    {
        Page::where('slug', $slug)->first()->toggleStatus();

        return redirect()->back()->with('status', 'Page status has been changed');
    }
}
