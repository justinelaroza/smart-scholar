<?php

namespace App\Events;

use App\Models\Scholarship;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScholarshipCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $scholarship;

    public function __construct(Scholarship $scholarship)
    {
        $this->scholarship = $scholarship;
    }

    public function broadcastOn()
    {
        return new Channel('scholarships');
    }

    public function broadcastAs()
    {
        return 'scholarship.created';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->scholarship->id,
            'title' => $this->scholarship->title,
            'description' => $this->scholarship->description,
            'funder' => $this->scholarship->funder,
            'education_level' => $this->scholarship->education_level,
            'status' => $this->scholarship->status,
            'submission_deadline' => $this->scholarship->submission_deadline,
            'amount' => $this->scholarship->amount,
            'image_url' => $this->scholarship->image_url,
        ];
    }
}