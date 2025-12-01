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
        $data = [
            'application_id' => $this->application->id,
            'scholarship_id' => $this->application->scholarship_id,
            'scholarship_title' => $this->application->scholarship->title,
            'progress' => $this->application->progress,
            'qr_code_base64' => null
        ];

        if ($this->application->progress === 'Approved' && !empty($this->application->qr_code)) {
            $data['qr_code_base64'] = base64_encode($this->application->qr_code);
        }

        return $data;
    }
}