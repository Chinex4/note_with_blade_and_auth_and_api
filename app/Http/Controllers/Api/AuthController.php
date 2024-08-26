<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Register a user
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:150',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:25'
        ],
        [
            'name.required' => 'Please fill in the name field',
            'name.min' => 'Name should be at least :min characters',
            'name.max' => 'Name should not be more than :max characters',
        ]);

        // dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'data'=> $user,
            'message' => 'Registration was successful',
            'statusCode' => 200
        ]);
    }

    /**
     * Login a user
     */
    public function login(Request $request)
    {
        $userDetails = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:25'
        ]);

        if (Auth::attempt($userDetails)) {
        $user = Auth::user(); // Retrieve the authenticated user
        $token = $user->createToken('My Token')->plainTextToken;

        $authUser = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'message' => 'Logged in successfully',
            'statusCode' => 200,
            'data' => $authUser
        ]);
    }

    return response()->json([
        'message' => 'Invalid login credentials',
        'statusCode' => 401,
    ], 401);
    }

    public function profile()
    {
        $user = Auth::user();

        if($user){
            return response()->json([
                'message' => 'User Profile',
                'statusCode' => 200,
                'data' => $user
            ]);
        }

        return response()->json([
            'message' => 'Unauthorised',
            'statusCode' => 401
        ]);

    }

    public function logout()
    {
        //
    }


}
