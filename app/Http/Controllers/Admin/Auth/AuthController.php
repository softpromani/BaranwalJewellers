<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle login request
     */
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            toast('Welcome Admin', 'success');
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle password change request
     */
    public function changePassword(Request $request){
    // Step 1: Validate input (Current Password, New Password, Confirm Password)
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|confirmed|min:4',
    ]);

    // Step 2: Get the current logged-in user
    $user = Auth::user();

    // Step 3: Check if the current password is correct
    if (!Hash::check($request->current_password, $user->password)) {
        // Agar current password galat hai to error return karein
        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    // Step 4: Update the password
    User::find(Auth::user()->id)->update([
        'password' => Hash::make($request->new_password),
    ]);

    // Step 5: Redirect with a success message
    return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully!');
}

}
