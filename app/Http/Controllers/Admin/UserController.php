<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function userProfile()
    {
        $user = User::find(Auth::user()->id);
        return view('admin.profile.user-profile', compact('user'));
    }

    function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
