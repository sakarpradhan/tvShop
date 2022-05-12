<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
    public function create()
    {
        // show user login page
        return view('tvshop.sessions.create');
    }

    public function store()
    {
        // validate user credentials from login form
        $attributes = request()->validate([
           'email'      => ['required', 'email'],
           'password'   => ['required', 'min:5']
        ]);

        // compare and authenticate the credentials
        // log the user in
        if (auth()->attempt($attributes))
        {
            session()->flash('success', "Welcome back");
            return redirect('/');
        }

        // auth fails
        return back()->withErrors(['email' => 'Credentials mismatch. Please try again.']);
    }

    public function destroy()
    {
        session()->flash('success', 'User logged out.');
        auth()->logout();
        return redirect('/');
    }
}
