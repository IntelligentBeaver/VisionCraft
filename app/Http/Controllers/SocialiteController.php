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

            // Default image URL (your placeholder image)
            $imageUrl = 'images/avatar/placeholder.jpg';

            // Check if the user already exists with Google ID or email
            $user = User::where('google_id', $googleUser->id)->first();
            $userWithEmail = User::where('email', $googleUser->email)->first();

            if ($userWithEmail) {
                // If a user with the same email already exists, merge accounts
                $userWithEmail->google_id = $googleUser->id;
                $userWithEmail->image = $imageUrl; // Use the placeholder image
                $userWithEmail->save();
                Auth::login($userWithEmail);
                return redirect()->route('dashboard');
            }

            if ($user) {
                // If a user with the same Google ID already exists, login
                $user->image = $imageUrl; // Use the placeholder image
                $user->save();
                Auth::login($user);
                return redirect()->route('dashboard');
            }

            // Create a new user with the profile data and placeholder image
            $userData = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make('Password@1234'),
                'google_id' => $googleUser->id,
                'image' => $imageUrl, // Store the placeholder image URL
                'role'=>'user'
            ]);

            if ($userData) {
                Auth::login($userData);
                return redirect()->route('dashboard');
            }

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

            // Default image URL (your placeholder image)
            $imageUrl = 'images/avatar/placeholder.jpg';

            // Check if the user already exists with LinkedIn ID or email
            $user = User::where('linkedin_id', $linkedinUser->id)->first();
            $userWithEmail = User::where('email', $linkedinUser->email)->first();

            if ($userWithEmail) {
                // If a user with the same email already exists, merge accounts
                $userWithEmail->linkedin_id = $linkedinUser->id;
                $userWithEmail->image = $imageUrl; // Use the placeholder image
                $userWithEmail->save();
                Auth::login($userWithEmail);
                return redirect()->route('dashboard');
            }

            if ($user) {
                // If a user with the same LinkedIn ID already exists, login
                $user->image = $imageUrl; // Use the placeholder image
                $user->save();
                Auth::login($user);
                return redirect()->route('dashboard');
            }

            // Create a new user with the profile data and placeholder image
            $userData = User::create([
                'name' => $linkedinUser->name,
                'email' => $linkedinUser->email,
                'password' => Hash::make('password@123'),
                'linkedin_id' => $linkedinUser->id,
                'image' => $imageUrl, // Store the placeholder image URL
            ]);

            if ($userData) {
                Auth::login($userData);
                return redirect()->route('dashboard');
            }

        } catch (Exception $e) {
            dd($e);
        }
    }
}