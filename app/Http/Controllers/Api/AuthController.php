<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        //
        $request->validate(
            [
                'name' => 'required|min:5|max:150',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|max:25',
            ],
            [
                'name.required' => 'Please fill in the name fields',
                'name.min' => 'Name field must be at least up to :min characters',
                'password.min' => 'Password must be at least up to :min characters',
                'name.max' => 'Name field should not exceed :max characters',
                'password.required' => 'Password is required'
            ]

        );
        // dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'data' => $user,
            'message' => 'Registration Successful',
            'statusCode' => 200,
        ]);
    }

    /**
     * Login the user
     */
    public function login(Request $request)
    {
        //
        $inputData = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8|max:25',
            ],
            [
                'password.min' => 'Password must be at least up to :min characters',
                'password.required' => 'Password is required'
            ]
        );

        if (Auth::attempt($inputData)) {
            $user = Auth::user();
            $token = $user->createToken('My Token')->plainTextToken;

            $authUser = [
                'user' => $user,
                'token' => $token
            ];
        }

        return response()->json([
            "data" => $authUser,
            "message" => "Login Successful",
            "statusCode" => 200,
        ]);
    }
    public function profile()
    {
        //
        $user = Auth::user();
        if ($user) {
            # code...
            return response()->json([
                "data" => $user,
                "message" => "User Profile",
                "statusCode" => 200,
            ]);
        }
        return response()->json([
            "message" => "Unauthorized",
            "statusCode" => 401,
        ]);
    }
    public function logout()
    {
        //
        $user = Auth::user();
        if ($user) {
            # code...
            $user->currentAccessToken()->delete();
            return response()->json([
                "message" => "Logged out successfully",
                "statusCode" => 200,
            ]);
        }

        return response()->json([
            "message" => "Unauthorized: You are not logged in.",
            "statusCode" => 401,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteProfile()
    {
        //
        $authenticatedUser = Auth::user();
        if ($authenticatedUser) {
            # code...
            $user = request()->user();
            $user->delete();
            return response()->json([
                "message" => "Account Deleted Successfully",
                "statusCode" => 200,
            ]);
        }

        return response()->json([
            "message" => "Unauthorized: User not logged in ",
            "statusCode" => 401,
        ]);

    }
}
