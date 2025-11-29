<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cron\UpdateScholarshipStatusController;
use App\Http\Controllers\Api\BroadcastController;

Route::get('/cron/update-scholarships', [UpdateScholarshipStatusController::class, 'updateScholarshipStatus']);


    Route::post('/broadcast/scholarship-created', [BroadcastController::class, 'scholarshipCreated']);
    Route::post('/broadcast/scholarship-updated', [BroadcastController::class, 'scholarshipUpdated']);
    Route::post('/broadcast/scholarship-deleted', [BroadcastController::class, 'scholarshipDeleted']);
