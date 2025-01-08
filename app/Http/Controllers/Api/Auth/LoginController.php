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
            'phone' => 'required|string|max:15',
            'fcm_token' => 'nullable',
        ]);

        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422); // Correct status code usage
        }

        // Validation passed, proceed with login or registration
        $validatedData = $validator->validated();

        $user = User::updateOrCreate(
            ['phone' => $validatedData['phone']], // Search by phone
            [
                'fcm_token' => isset($validatedData['fcm_token']) ? $validatedData['fcm_token'] : null
            ] // Update or set fcm_token based on its existence
        );

        // Check if the user was recently created
        if ($user->wasRecentlyCreated) {
            $user->is_registered = false;
        } else {
            $user->is_registered = true;
        }

        // Generate API token
        $token = $user->createToken('Api Token')->accessToken;

        // Return the response
        return response()->json([
            'data' => $user,
            'token' => $token,
        ], 200);
    }
}
