<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SocialiteController extends Controller
{

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthenticationCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)->first();
            if ($user) {
                //User is already registered, login him in
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                //User is not registered, create him in the database
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('Password@1234'), //You can add your own password hashing here if you want. For now, we're using bcrypt.
                    'google_id' => $googleUser->id,
                ]);
                if ($userData) {
                    //User created successfully, login him in
                    Auth::login($userData);
                    return redirect()->route('dashboard');
                }
            }
            //Login the user
            Auth::login($user);
            return redirect()->route('home');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function linkedInLogin()
    {
        return Socialite::driver('linkedin-openid')->redirect();
    }

    public function linkedInAuthenticationCallback()
    {
        try {
            $linkedinUser = Socialite::driver('linkedin-openid')->user();

            $user = User::where('linkedin_id', $linkedinUser->id)->first();
            if ($user) {
                //User is already registered, login him in
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                //User is not registered, create him in the database
                $userData = User::create([
                    'name' => $linkedinUser->name,
                    'email' => $linkedinUser->email,
                    'password' => Hash::make('Password@1234'), //You can add your own password hashing here if you want. For now, we're using bcrypt.
                    'linkedin_id' => $linkedinUser->id,
                ]);
                if ($userData) {
                    //User created successfully, login him in
                    Auth::login($userData);
                    return redirect()->route('dashboard');
                }
            }
            //Login the user
            Auth::login($user);
            return redirect()->route('dashboard');

        } catch (Exception $e) {
            dd($e);
        }
    }
}