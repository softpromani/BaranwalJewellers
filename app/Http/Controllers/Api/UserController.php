<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   function profile_update(Request $req){
$validate=Validator::make($req->all(),[

    'first_name'=>'required|string|max:255',
    'last_name'=>'nullable',
    'email'=>'nullable|email',
    'city'=>'nullable',
    'state'=>'nullable',
    'country'=>'nullable',
    'pincode'=>'nullable',
    'address'=>'nullable',
 
]);

if ($validate->fails()) {
    return response()->json([
        'message' => 'Validation failed',
        'errors' => $validate->errors(),
    ], status: 422);
}

       $validateData = $validate->validate();
       $user=auth('api')->user()->update($validateData);
   if($user==true){
       return response()->json(['data'=>auth(guard: 'api')->user(),'status'=>true,'message'=>'record updated successfully'],200);
       }
       else
       {
        return response()->json(['status'=>false,'message'=>'record not update'],200);
       }
    }

   }
