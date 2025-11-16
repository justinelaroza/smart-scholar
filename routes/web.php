<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\ScholarshipController;
use App\Http\Controllers\Pages\AboutController;
use App\Http\Controllers\Pages\SupportController;
use App\Http\Controllers\Pages\ProfileController;

/* Authentication */

//Login
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate')->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store')->middleware('throttle:3,1');
Route::post('/register/verify-otp', [RegisterController::class, 'verifyOtp'])->name('register.verifyOtp')->middleware('throttle:10,1');

//Forgot-Pass
Route::get('/forgot-pass', [ForgotPasswordController::class, 'show'])->name('forgot-pass');
Route::post('/forgot-pass', [ForgotPasswordController::class, 'update'])->name('forgot-pass.update')->middleware('throttle:3,1');
Route::post('/forgot-pass/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot-pass.verifyOtp')->middleware('throttle:10,1');

/* Public pages */

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/facebook-feed-ajax', [HomeController::class, 'feedAjax']);

//Scholarship
Route::middleware('auth')->group(function () {
  Route::get('/scholarship/{id}/create', [ScholarshipController::class, 'create'])->name('scholarship.create');
  Route::post('/scholarship/{id}/create', [ScholarshipController::class, 'storeGeneralInfo'])->name('scholarship.generalinfo');
  Route::get('/scholarship/{id}/upload', [ScholarshipController::class, 'upload'])->name('scholarship.upload');
  Route::post('/scholarship/{id}/upload', [ScholarshipController::class, 'storeFileUpload'])->name('scholarship.fileupload');
  Route::get('/scholarship/{id}/progress', [ScholarshipController::class, 'progressReport'])->name('scholarship.progress');
  Route::patch('/fileupload/{id}/resubmit/', [ScholarshipController::class, 'resubmit'])->name('fileupload.resubmit');
  Route::get('/file/{id}/{field}', [ScholarshipController::class, 'view'])->name('file.view');
  Route::get('profile', [ProfileController::class, 'index'])->name('profile');
});

Route::get('/scholarship', [ScholarshipController::class, 'index'])->name('scholarship');
Route::get('/scholarship/{id}', [ScholarshipController::class, 'show'])->name('scholarship.show');



//About
Route::get('/about', [AboutController::class, 'show'])->name('about');

//Support
Route::get('/support', [SupportController::class, 'show'])->name('support');

//Profile



