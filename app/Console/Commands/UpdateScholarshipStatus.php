<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Scholarship;
use Carbon\Carbon;

class UpdateScholarshipStatus extends Command
{
    protected $signature = 'scholarships:update-status';
    protected $description = 'Automatically close scholarships after the deadline';

    public function handle()
    {
        $today = Carbon::today();

        $count = Scholarship::where('status', 'Open')->where('submission_deadline', '<', $today)->update(['status' => 'Close']);

        return $count;
    }
}