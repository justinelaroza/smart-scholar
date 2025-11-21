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
    
    $count = Artisan::call('scholarships:update-status');
    return "Updated {$count} scholarships to Close!";
  }
}