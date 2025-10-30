<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\ScholarshipController;
use App\Http\Controllers\Pages\AboutController;
use App\Http\Controllers\Pages\SupportController;
use App\Http\Controllers\FacebookController;

// Public pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::get('/forgot-pass', [ForgotPasswordController::class, 'show'])->name('forgot-pass');
Route::get('/about', [AboutController::class, 'show'])->name('about');
Route::get('/support', [SupportController::class, 'show'])->name('support');

Route::get('/facebook-feed-ajax', [FacebookController::class, 'feedAjax']);

// Scholarship routes
Route::middleware('auth')->group(function () {
    Route::get('/scholarship', [ScholarshipController::class, 'index'])->name('scholarship');
    Route::get('/scholarship/show', [ScholarshipController::class, 'show'])->name('scholarship.show'); 
    Route::get('/scholarship/create', [ScholarshipController::class, 'create'])->name('scholarship.create');
    Route::get('/scholardhip/upload', [ScholarshipController::class, 'upload'])->name('scholarship.upload');
});

Route::post('/register/step1', [RegisterController::class, 'storeStep1'])
    ->name('register.step1')
    ->middleware('throttle:3,1');

Route::post('/register/verify-otp', [RegisterController::class, 'verifyOtp'])
    ->name('register.verifyOtp')
    ->middleware('throttle:10,1');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.attempt');

// (Later we'll add: Route::post('/register/verify-otp', ...) for Verify button)
