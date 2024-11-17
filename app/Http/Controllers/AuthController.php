<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private function saltgenerator($length = 6) {
        $characters = '0123456789';
        $saltvalue = '';
        $charactersLength = strlen($characters);
        $randomnumber = bin2hex(random_bytes(8)); // 16 characters in hex
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, $charactersLength - 1);
            $saltvalue .= $characters[$randomIndex];
        }
        $saltvalue .= $randomnumber;
        return $saltvalue;
    }

    private function customHashPassword($password, $salt)
    {
        $passwordWithSalt = $password . $salt;
        return bcrypt($passwordWithSalt);
    }

    private function verifyCustomHashedPassword($password, $hashedPassword, $salt)
    {
        $passwordWithSalt = $password . $salt;
        return password_verify($passwordWithSalt, $hashedPassword);
    }

    public function signup(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'error' => $validateUser->errors()->all(),
            ], 422);
        }

        $salt = $this->saltgenerator();
        $hashedPassword = $this->customHashPassword($request->password, $salt);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => $hashedPassword,
            'salt' => $salt,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully signed up',
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

        $user = User::where('email', $request->email)->first();
        if($user->salt){
        if ($user && $this->verifyCustomHashedPassword($request->password, $user->password, $user->salt)) {
            Auth::login($user);
            $authUser = Auth::user();
            return response()->json([
                'status' => true,
                'message' => 'Successfully logged in',
                'id' => $authUser->id,
                'token' => $authUser->createToken("API Token")->plainTextToken,
                'token_type' => 'bearer',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email and password do not match',
            ], 401);
        }
     }
else{
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




    }

    public function signout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out',
            'user' => $user,
        ], 200);
    }
}