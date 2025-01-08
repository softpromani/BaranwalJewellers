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
    public function changePassword(Request $request)
    {
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

    public function profile_update(Request $request)
    {
        // dd($request->all());
        $data = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'alternate_number' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'pincode' => 'nullable',
            'image' => 'nullable',
            'about' => 'nullable',
            'company' => 'nullable',
            'profession' => 'nullable',
            'address' => 'nullable',
            'password' => 'nullable',

        ];
        $profile = User::find(Auth::user()->id);

        if ($request->hasFile(key: 'image')) {
            $file = $request->file('image');
            $path = $file->store('profile_image', 'public');
            $profile->update(['image'=>$path]);
        }
        $profile->update([
            'first_name' => $request->first_name ?? $profile->first_name,
            'last_name' => $request->last_name ?? $profile->last_name,
            'email' => $request->email ?? $profile->email,
            'phone' => $request->phone ?? $profile->phone,
            'alternate_number' => $request->alternate_number ?? $profile->alternate_number,
            'city' => $request->city ?? $profile->city,
            'state' => $request->state ?? $profile->state,
            'country' =>$request->country ?? $profile->country,
            'pincode' => $request->pincode ?? $profile->pincode,
            'about' => $request->about ?? $profile->about,
            'company' =>$request->company ?? $profile->company,
            'profession' => $request->profession ?? $profile->profession,
            'address' => $request->address ?? $profile->address,

        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function dump()
    {
        User::create([
            'first_name' => 'Alok',
            'last_name' => 'Baranwal',
            'name' => 'Alok Baranwal',
            'email' => 'admin@gmail.com',
            'phone' => '8896287276',
            'alternate_number' => '8896287276',
            'about' => 'Sample about',
            'company' => 'Baranwal Alankar Mandir',
            'profession' => 'Businessman',
            'city' => 'Ghazipur',
            'state' => 'Uttar Pradesh',
            'country' => 'India',
            'address' => 'Bahadurganj, Ghazipur',
            'pincode' => '275201',
            'password' => Hash::make('Admin@2024'),
            'is_admin' => 1
        ]);

        return true;
    }

    public function fetchLiveSpotRate()
    {
        fetchAuthorityRates();
        return redirect()->back();
    }
}
