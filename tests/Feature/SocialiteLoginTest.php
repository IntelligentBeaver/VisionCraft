<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as OAuthUser;

function fakeOAuthUser(string $id, string $email, bool $verified): void
{
    $oauthUser = (new OAuthUser)
        ->setRaw(['sub' => $id, 'email' => $email, 'email_verified' => $verified])
        ->map(['id' => $id, 'name' => 'OAuth Person', 'email' => $email]);

    Socialite::shouldReceive('driver->user')->andReturn($oauthUser);
}

it('creates a new user with a random password', function () {
    fakeOAuthUser('g-1', 'new@example.com', true);

    $this->get('/auth/google-callback')->assertRedirect(route('welcome'));

    $user = User::where('email', 'new@example.com')->firstOrFail();
    expect($user->google_id)->toBe('g-1')
        ->and($user->role)->toBe('user')
        ->and(Hash::check('Password@1234', $user->password))->toBeFalse();
    $this->assertAuthenticatedAs($user);
});

it('links an existing account when the provider verified the email', function () {
    $existing = User::factory()->create(['email' => 'me@example.com']);
    fakeOAuthUser('li-1', 'me@example.com', true);

    $this->get('/auth/linkedin-callback')->assertRedirect(route('welcome'));

    expect($existing->fresh()->linkedin_id)->toBe('li-1');
    $this->assertAuthenticatedAs($existing);
});

it('refuses to link an existing account with an unverified email', function () {
    $existing = User::factory()->create(['email' => 'me@example.com']);
    fakeOAuthUser('g-2', 'me@example.com', false);

    $this->get('/auth/google-callback')->assertRedirect(route('login'));

    expect($existing->fresh()->google_id)->toBeNull();
    $this->assertGuest();
});

it('keeps an existing profile image', function () {
    $user = User::factory()->create(['google_id' => 'g-3', 'image' => 'images/me.png']);
    fakeOAuthUser('g-3', $user->email, true);

    $this->get('/auth/google-callback');

    expect($user->fresh()->image)->toBe('images/me.png');
});

it('redirects to login instead of dumping when the provider fails', function () {
    Socialite::shouldReceive('driver->user')->andThrow(new RuntimeException('boom'));

    $this->get('/auth/google-callback')
        ->assertRedirect(route('login'))
        ->assertSessionHas('error');
});
