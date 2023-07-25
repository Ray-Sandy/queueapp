<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class QueueStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $queueId;
    public $status;

    /**
     * Create a new event instance.
     *
     * @param  int  $queueId
     * @param  string  $status
     * @return void
     */
    public function __construct($queueId, $status)
    {
        $this->queueId = $queueId;
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('queue-status');
    }

    /**
     * Get the event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'status.updated';
    }
}
