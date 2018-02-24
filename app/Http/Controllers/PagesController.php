<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index($page_slug)
    {
        $page = Page::where('slug', $page_slug)->firstOrFail();
        $elements = $page->getElements()->pluck('content', 'title')->all();

        if(\View::exists('pages.' . $page_slug)) {
            return view('pages.' . $page_slug, array_merge(['page' => $page], $elements));
        }

        return view('pages.defaultPage', array_merge(['page' => $page], $elements));
    }
}
