<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        // shows registration page
        return view('tvshop.register.create');
    }

    public function store()
    {
        // register the user
        // validate the data received through the form
        $attributes = request()->validate([
            'name'      => ['required'],
            'email'     => ['required', 'email', Rule::unique('users', 'email')],
            'password'  => ['required', 'min:5']
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        session()->flash('success', 'User created and logged in.');

        auth()->login($user);

        return redirect('/');
    }
}
