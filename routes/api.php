<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cron\UpdateScholarshipStatusController;

Route::get('/cron/update-scholarships', [UpdateScholarshipStatusController::class, 'updateScholarshipStatus']);