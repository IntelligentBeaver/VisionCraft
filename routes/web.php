<?php

use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google','googleLogin')->name('auth.google');
Route::get('auth/google-callback','googleAuthenticationCallback')->name('auth.google-callback');
});

Route::controller(SocialiteController::class)->group((function () {
    Route::get('auth/linkedin','linkedInLogin')->name('auth.linkedin');
    Route::get('auth/linkedin-callback', 'linkedInAuthenticationCallback')->name('auth.linkedin-callback');
}));


// TODO: Adde Functionality of Account Merge
//  Route::get('auth/merge-accounts',function(){
//     return view('auth.merge-accounts');
//  })->name('auth.merge-accounts');

Route::middleware('guest')->get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware('guest')->get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name(name: 'logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});