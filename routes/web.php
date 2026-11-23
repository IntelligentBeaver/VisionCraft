<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResController;
use App\Http\Controllers\SocialiteController;
use App\Livewire\Dashboard\CreateUser;
use App\Livewire\Dashboard\ManageUsers;
use App\Livewire\Dashboard\UserStats;
use App\Livewire\ResumeOptimizer;
use App\Livewire\UserRecommendations;
use App\Livewire\UserSurveyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


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

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('welcome'); // Ensure you have a named route for welcome
})->name('logout');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/admin/create', 'dashboard.create-user')->name('dashboard.create');
    Route::view('/admin/manage', 'dashboard.manage-users')->name('dashboard.manage');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/stats', UserStats::class)->name('dashboard-stats');
    Route::get('/admin/users/create', CreateUser::class)->name('dashboard-create');
    Route::get('/admin/users/manage', ManageUsers::class)->name('dashboard-manage');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', UserRecommendations::class)->name('user-dashboard');
    Route::get('/user/survey/history', UserSurveyHistory::class)->name('user-survey-history');
});

// Resume optimizer and job recommendations (backed by the Flask API)
Route::middleware(['auth'])->group(function () {
    Route::get('/resume-upload', ResumeOptimizer::class)->name('resume-upload');

    Route::get('/upload-resume-form', [ResController::class, 'showResumeForm'])->name('resume.form');
    Route::post('/upload-resume', [ResController::class, 'uploadResume'])->name('resume.upload');
    Route::get('/download-resume/{filename}', [ResController::class, 'downloadResume'])->name('resume.download');

    Route::get('/recommend-jobs-form', [ResController::class, 'showRecommendationForm'])->name('jobs.recommend.form');
    Route::post('/recommend-jobs', [ResController::class, 'recommendJobs'])->name('jobs.recommend');

    Route::view('/resume/process', 'resume_process');
    Route::view('resume/upload', 'resume_upload');
});
