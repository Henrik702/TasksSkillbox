<?php

namespace App\Listeners;

use App\Events\TaskCreate;
use App\Mail\TaskCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTaskCreate
{

    /**
     * Handle the event.
     *
     * @param  TaskCreate  $event
     * @return void
     */
    public function handle(TaskCreate $event)
    {
        \Mail::to($event->task->owner->email)->send(
            new TaskCreated($event->task)
        );
    }
}
