<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
<<<<<<< HEAD

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
=======
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
>>>>>>> 13b28941b16e9ca251826169742fb9a4c84e35e9
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
<<<<<<< HEAD
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
=======
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

>>>>>>> 13b28941b16e9ca251826169742fb9a4c84e35e9
        // dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
<<<<<<< HEAD
            'data' => $user,
            'message' => 'Registration Successful',
            'statusCode' => 200,
=======
            'data'=> $user,
            'message' => 'Registration was successful',
            'statusCode' => 200
>>>>>>> 13b28941b16e9ca251826169742fb9a4c84e35e9
        ]);
    }

    /**
<<<<<<< HEAD
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
=======
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


>>>>>>> 13b28941b16e9ca251826169742fb9a4c84e35e9
}
