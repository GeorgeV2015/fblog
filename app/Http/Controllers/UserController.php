<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);

        return view('pages.user', compact('user'));
    }
}
