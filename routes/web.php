<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\ScholarshipController;
use App\Http\Controllers\Pages\AboutController;
use App\Http\Controllers\Pages\SupportController;

/* Authentication */

//Login
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate')->middleware('throttle:5,1');

//Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store')->middleware('throttle:3,1');
Route::post('/register/verify-otp', [RegisterController::class, 'verifyOtp'])->name('register.verifyOtp')->middleware('throttle:10,1');

//Forgot-Pass
Route::get('/forgot-pass', [ForgotPasswordController::class, 'show'])->name('forgot-pass');

/* Public pages */

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/facebook-feed-ajax', [HomeController::class, 'feedAjax']);

//Scholarship
Route::get('/scholarship', [ScholarshipController::class, 'index'])->name('scholarship');
Route::get('/scholarship/{id}', [ScholarshipController::class, 'show'])->name('scholarship.show');

Route::middleware('auth')->group(function () {
  Route::get('/scholarship/create', [ScholarshipController::class, 'create'])->name('scholarship.create');
  Route::get('/scholarship/upload', [ScholarshipController::class, 'upload'])->name('scholarship.upload');
});

//About
Route::get('/about', [AboutController::class, 'show'])->name('about');

//Support
Route::get('/support', [SupportController::class, 'show'])->name('support');


