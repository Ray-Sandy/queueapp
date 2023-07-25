<?php

namespace App\Listeners;

use App\Models\Queue;
use App\Events\ResetQueueNumber;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class ResetQueueNumberListener
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
     * @param  \App\Events\ResetQueueNumber  $event
     * @return void
     */
    public function handle(ResetQueueNumber $event)
    {
        Queue::whereDate('created_at', '<', now()->startOfDay())->update(['queue_number' => 1]);
    }
}
