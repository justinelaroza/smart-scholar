<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileUploadApiController;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/file-uploads/{id}/document/{field}/download', [FileUploadApiController::class, 'downloadDocument']);
    Route::get('/file-uploads/{id}/document/{field}/view', [FileUploadApiController::class, 'viewDocument']);
});