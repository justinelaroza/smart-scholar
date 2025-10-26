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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::get('/forgot-pass', [ForgotPasswordController::class, 'show'])->name('forgot-pass');
Route::get('/about', [AboutController::class, 'show'])->name('about');
Route::get('/support', [SupportController::class, 'show'])->name('support');

Route::get('/facebook-feed-ajax', [FacebookController::class, 'feedAjax']);

Route::get('/scholarship', [ScholarshipController::class, 'index'])->name('scholarship');
Route::get('/scholarship/show', [ScholarshipController::class, 'show'])->name('scholarship.show'); 
Route::get('/scholarship/create', [ScholarshipController::class, 'create'])->name('scholarship.create');
Route::get('/scholardhip/upload', [ScholarshipController::class, 'upload'])->name('scholarship.upload');