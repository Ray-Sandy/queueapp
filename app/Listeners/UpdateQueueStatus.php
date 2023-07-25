<?php

namespace App\Listeners;

use App\Events\QueueStatusUpdated;

class QueueStatusListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        broadcast(new QueueStatusUpdated($event->queue))->toOthers();
    }
}
