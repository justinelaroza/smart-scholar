<?php

namespace App\Events;

use App\Models\FileUpload;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApplicationProgressUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $application;

    public function __construct(FileUpload $application)
    {
        if (!$application->relationLoaded('scholarship')) {
            $application->load('scholarship');
        }
        
        $this->application = $application;
    }

    public function broadcastOn()
    {
        return new Channel('user.' . $this->application->user_id);
    }

    public function broadcastAs()
    {
        return 'application.progress.updated';
    }

    public function broadcastWith()
    {
        return [
            'application_id' => $this->application->id,
            'scholarship_title' => $this->application->scholarship->title,
            'progress' => $this->application->progress,
        ];
    }
}