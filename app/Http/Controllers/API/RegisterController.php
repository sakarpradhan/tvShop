<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(UserFormRequest $request)
    {
        $attribute = $request->validated();

        $attribute['password'] = bcrypt($attribute['password']);

        $user = User::create($attribute);

        $token = $user->createToken($attribute['email'])->plainTextToken;

        return response()->json([
            'user'  =>  $user,
            'token' =>  $token
        ], 201);
    }

    public function login()
    {
        $attribute = request()->validate([
            'email'      => ['required', 'email'],
            'password'   => ['required', 'min:5']
        ]);

        if (auth()->attempt($attribute))
        {
            $token = auth()->user()->createToken($attribute['email'])->plainTextToken;

            return response()->json([
                'user'  =>  auth()->user(),
                'token' =>  $token
            ], 201);
        }

        // auth fails
        return response()->json([
            'status' => '401',
            'error' => 'Authentication failed.'
        ], 401);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message'   =>  'The user has been logged out. Tokens reset.'
        ]);
    }
}
