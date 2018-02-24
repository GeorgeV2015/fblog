<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller {

    public function index()
    {
        $user = Auth::user();

        return view('pages.profile', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'nullable|min:3',
            'avatar'   => 'nullable|image|max:200'
        ]);

        $user->edit($request->all());
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->route('profile')->with('status', 'Profile has been successfully updated');
    }
}
