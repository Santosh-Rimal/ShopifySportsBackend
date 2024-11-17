<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6', // Adding a minimum length for password
        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'error' => $validateUser->errors()->all(),
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => $request->password, // Encrypting the password
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully Signup',
            'user' => $user,
        ], 200);
    }

    public function signin(Request $request)
{
    $validateUser = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if ($validateUser->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'error' => $validateUser->errors()->all(),
        ], 422);
    }

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $authUser = Auth::user();
        return response()->json([
            'status' => true,
            'message' => 'Successfully loggedin',
            'id'=>$authUser->id,
            'token' => $authUser->createToken("API Token")->plainTextToken,
            'token_type' => 'bearer'
        ], 200);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Email and password do not match',
        ], 401); // Changed to 401 for unauthorized access
    }
}

    public function signout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully Logout',
            'user' => $user,
        ], 200);
    }
}