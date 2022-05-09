<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        // shows registration page
        return view('tvshop.register.create');
    }

    public function store(UserFormRequest $request)
    {
        // register the user
        // validate the data received through the form
        // Retrieve the validated input data...
        $attributes = $request->validated();

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        session()->flash('success', 'User created and logged in.');

        auth()->login($user);

        return redirect('/');
    }
}
