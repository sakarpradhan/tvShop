<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('getUserDetails'))
{
    function getUserDetails()
    {
        $user = Auth::user();
        return $user;
    }
}

if (!function_exists('isUserAdmin'))
{
    function isUserAdmin()
    {
        return (Auth::user()->admin) ? true : false;
    }
}
