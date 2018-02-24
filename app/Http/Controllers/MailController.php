<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {

    public function index(Request $request)
    {
        $this->validate($request, [
            'name'                 => 'required|string|min:2|max:128',
            'email'                => 'required|email',
            'message'              => 'required',
            'g-recaptcha-response' => 'required|recaptcha'
        ]);
        $email = User::find(1)->email;
        Mail::to($email)->send(new ContactUs($request->all()));

        return redirect()->back()->with('status', 'Your message has been sent');
    }
}
