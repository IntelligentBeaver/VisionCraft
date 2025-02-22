<?php

use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\FlaskController;
use App\Http\Controllers\ResController;

Route::view('/', 'welcome');


// Socialite authentication
Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google', 'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthenticationCallback')->name('auth.google-callback');
});

Route::controller(SocialiteController::class)->group((function () {
    Route::get('auth/linkedin', 'linkedInLogin')->name('auth.linkedin');
    Route::get('auth/linkedin-callback', 'linkedInAuthenticationCallback')->name('auth.linkedin-callback');
}));


Route::middleware('guest')->group((function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
}));

// User routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/settings', [ProfileController::class, 'show'])->name('profile.settings');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name(name: 'logout');


Route::middleware(['auth'])->group(function () {
    Route::view('/admin/create', 'dashboard.create-user')->name('dashboard.create');
    Route::view('/admin/manage', 'dashboard.manage-users')->name('dashboard.manage');
});

// Route::get('/flask-view', [FlaskController::class, 'showFlaskData']);
// Route::post('/get-recommendations', function (Request $request) {
//     $response = Http::post('http://127.0.0.1:5000/recommend', [
//         'skills' => $request->input('skills'),
//         'industry' => $request->input('industry'),
//         'functional_area' => $request->input('functional_area')
//     ]);

//     return response()->json($response->json());
// });
// // Route to display form
// Route::get('/flask-form', [FlaskController::class, 'showForm']);

// // Route to handle form submission and send data to Flask
// Route::post('/send-to-flask', [FlaskController::class, 'sendToFlask']);

Route::post('/upload-resume', [ResController::class, 'uploadResume']);
Route::get('/download-resume/{filename}', [ResController::class, 'downloadResume']);
Route::post('/recommend-jobs', [ResController::class, 'recommendJobs']);
Route::get('/show-form', [ResController::class, 'showForm']);

Route::view('/resume/process', 'resume_process');
Route::view('resume/upload', 'resume_upload');