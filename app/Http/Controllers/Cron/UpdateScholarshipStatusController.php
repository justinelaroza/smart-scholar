<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class UpdateScholarshipStatusController extends Controller
{
  public function updateScholarshipStatus()
  {
    if (request()->header('X-Cron-Secret') !== config('app.cron_secret')) {
      abort(403);
    }
    
    Artisan::call('scholarships:update-status');
    return response()->json(['success' => true, 'message' => 'Scholarships updated']);
  }
}