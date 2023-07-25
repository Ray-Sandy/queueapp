<?php

namespace App\Events;

use App\Models\Queue;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QueueCalled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $queue;

    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }

    public function broadcastOn()
    {
        return ['queue-called'];
    }
    public function broadcastAs()
{
    return 'status-updated';
}

}

