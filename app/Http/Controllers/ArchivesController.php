<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchivesController extends Controller
{
    public function index($year, $month)
    {

        $posts = Post::with('category', 'author')->published()->ordered()->dataFilter(compact('year', 'month'))->paginate(6);

        $title = "Archives: $month, $year";

        return view('home', compact('posts', 'title'));
    }
}
