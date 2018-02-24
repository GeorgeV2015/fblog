<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required',
            'avatar'   => 'nullable|image|max:100'
        ]);
        $user = User::add($request->all());
        $user->uploadAvatar($request->file('avatar'));
        $user->setRole($request->get('is_admin'));
        $user->setStatus($request->get('active'));

        return redirect()->route('users.index')->with('status', "User '$user->name' has been created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'   => 'required',
            'email'  => [
                'required',
                'email',
                Rule::unique('users')->ignore($id)
            ],
            'avatar' => 'nullable|image|max:100'
        ]);
        $user = User::find($id);
        $user->edit($request->all());
        $user->uploadAvatar($request->file('avatar'));
        $user->setRole($request->get('is_admin'));
        $user->setStatus($request->get('active'));

        return redirect()->route('users.index')->with('status', "User '$user->name' has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $userName = $user->name;
        $user->remove();

        return redirect()->route('users.index')->with('status', "User '$userName' has been deleted");
    }

    public function toggle($id)
    {
        User::find($id)->toggle();

        return redirect()->back()->with('status', 'User status has been changed');
    }

    public function toggleRole($id)
    {
        User::find($id)->toggleRole();

        return redirect()->back()->with('status', 'User role has been changed');
    }
}
