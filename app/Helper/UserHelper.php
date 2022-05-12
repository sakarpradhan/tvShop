<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function getUserDetails()
    {
        return Auth::user();
    }

    public static function isUserAdmin()
    {
        return (bool)Auth::user()->admin;
    }
}
