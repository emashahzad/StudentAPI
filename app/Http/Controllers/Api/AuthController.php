<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::create($data);
        $user->assignRole('user');
        Mail::to($user->email)->send(
            new WelcomeMail($user->name)
        );
        return response()->json([
            'message' => 'User Created Successfully',
            'user' => $user
        ], 201);
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid Email or Password'

            ], 401);
        }
        $token = $user->createToken('student-api-token')->plainTextToken;
        return response()->json([
            'message' => 'Login Successfull',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 200);
    }
    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        if ($token) {
            $token->delete();
        }
        return response()->json([
            'message' => 'Logout Successfull',
        ], 200);
    }
}
