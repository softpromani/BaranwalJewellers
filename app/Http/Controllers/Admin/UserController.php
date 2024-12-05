<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function userProfile()
    {
        return view('admin.profile.user-profile');
    }

    function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
