<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CreateScholarshipController;

Route::post('/scholarships/admin/create', [CreateScholarshipController::class, 'store']);