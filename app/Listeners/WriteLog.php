<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Log;
use App\Events\StoryCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WriteLog
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
     * @param  \App\Events\StoryCreated  $event
     * @return void
     */
    public function handle(StoryCreated $event)
    {
        Log::info("A new story was added with title ".$event->title);
    }
}
