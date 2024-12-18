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
        ]);

        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], status: 422);
        }

        // Validation passed, proceed with login or registration
        $validatedData = $validator->validated();
       $user= User::firstOrCreate(attributes: ['phone'=>$validatedData['phone']]);
       if($user->wasRecentlyCreated){
        $user->is_registered=false;
       }
       else
       {
        $user->is_registered=true;
       }
       $token = $user->createToken('Api Token')->accessToken;
       return response()->json(['data'=>$user,'token'=>$token],status: 200);


    }
}
