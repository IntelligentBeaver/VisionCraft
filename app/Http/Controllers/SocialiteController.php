<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialiteController extends Controller
{
    private const PLACEHOLDER_IMAGE = 'images/avatar/placeholder.jpg';

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthenticationCallback(Request $request): RedirectResponse
    {
        return $this->handleCallback($request, 'google', 'google_id');
    }

    public function linkedInLogin()
    {
        return Socialite::driver('linkedin-openid')->redirect();
    }

    public function linkedInAuthenticationCallback(Request $request): RedirectResponse
    {
        return $this->handleCallback($request, 'linkedin-openid', 'linkedin_id');
    }

    private function handleCallback(Request $request, string $driver, string $idColumn): RedirectResponse
    {
        try {
            $oauthUser = Socialite::driver($driver)->user();
        } catch (Throwable $e) {
            Log::warning("OAuth login failed for {$driver}", ['exception' => $e]);

            return redirect()->route('login')->with('error', 'Social login failed. Please try again.');
        }

        // Returning user: already linked to this provider account.
        $user = User::where($idColumn, $oauthUser->getId())->first();

        if (! $user && $oauthUser->getEmail()) {
            $existing = User::where('email', $oauthUser->getEmail())->first();

            if ($existing) {
                // Only link to an existing account when the provider has verified
                // the email, otherwise anyone could take over that account.
                if (! $this->emailIsVerified($oauthUser)) {
                    return redirect()->route('login')
                        ->with('error', 'This email is already registered. Log in with your password first.');
                }

                $existing->{$idColumn} = $oauthUser->getId();
                $existing->save();
                $user = $existing;
            }
        }

        if (! $user) {
            $user = User::create([
                'name' => $oauthUser->getName() ?: 'User',
                'email' => $oauthUser->getEmail(),
                // OAuth users never log in with a password; store an unguessable one.
                'password' => Hash::make(Str::random(64)),
                $idColumn => $oauthUser->getId(),
                'image' => self::PLACEHOLDER_IMAGE,
                'role' => 'user',
            ]);
        }

        if (! $user->image) {
            $user->image = self::PLACEHOLDER_IMAGE;
            $user->save();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('welcome');
    }

    private function emailIsVerified(SocialiteUser $oauthUser): bool
    {
        $raw = method_exists($oauthUser, 'getRaw') ? $oauthUser->getRaw() : [];

        return filter_var(Arr::get($raw, 'email_verified', false), FILTER_VALIDATE_BOOLEAN);
    }
}
