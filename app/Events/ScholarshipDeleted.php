<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScholarshipDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $scholarshipId;

    public function __construct($scholarshipId)
    {
        $this->scholarshipId = $scholarshipId;
    }

    public function broadcastOn()
    {
        return new Channel('scholarships');
    }

    public function broadcastAs()
    {
        return 'scholarship.deleted';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->scholarshipId,
        ];
    }
}