<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        try {
            //code...
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(24)), // You might not need a password in case of OAuth
                    'google_id' => $googleUser->getId(),
                ]);

                Auth::login($newUser);
                return redirect('/note');
            } else {
                Auth::login($user);
                return redirect('/note');
            }
        } catch (\Throwable $th) {
            dd('Something went wrong' . $th->getMessage());
        }
    }
}
