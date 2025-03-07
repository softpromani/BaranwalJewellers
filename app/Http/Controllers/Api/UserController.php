<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function profile_update(Request $req)
    {
        $validate = Validator::make($req->all(), [

            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable',
            'email' => 'nullable|email',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'pincode' => 'nullable',
            'address' => 'nullable',
            'fcm_token' => 'nullable',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validate->errors(),
            ], status: 422);
        }

        $validateData = $validate->validate();
        $user = auth('api')->user()->update($validateData);
        if ($user == true) {
            return response()->json(['data' => auth(guard: 'api')->user(), 'status' => true, 'message' => 'Profile updated successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'record not update'], 200);
        }
    }

    function profile_picture_update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'image' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validate->errors(),
            ], status: 422);
        }

        $path = Null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('profile_pic', 'public');
        }

        $user = User::where('id', auth('api')->user()->id)->update([ 'image' => $path ]);
        if ($user) {
            return response()->json(['data' => auth(guard: 'api')->user(), 'status' => true, 'message' => 'Profile picture updated successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Record not updated'], 200);
        }
    }

    function user_profile(){
        $profiles = User::find(auth('api')->user()->id);
    // Auth::user()->id
        return response()->json([
            'success' => true,
            'data' => $profiles
        ], 200);

    }
}
