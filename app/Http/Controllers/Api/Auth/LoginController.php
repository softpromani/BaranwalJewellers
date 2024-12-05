<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function loginOrRegister(Request $request)
    {
        // Validate the input manually
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Validation passed, proceed with login or registration
        $validatedData = $validator->validated();

        // Check if the user exists
        $user = User::where('phone', $validatedData['phone'])->first();

        if (!$user) {
            // Create a new user if not exists
            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'name' => $validatedData['first_name'].' '.$validatedData['last_name'],
                'phone' => $validatedData['phone']
            ]);
        }

        // Generate a token
        $token = $user->createToken('API Token')->accessToken;

        // Save the token in the database
        $user->update(['token' => $token]);

        return response()->json([
            'message' => 'Login successful!',
            'user' => $user,
        ], 200);
    }
}
