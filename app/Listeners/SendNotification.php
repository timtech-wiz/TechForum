<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use App\Mail\newStoryNotification;
use App\Events\StoryCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification
{
     
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->title = $title;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\StoryCreated  $event
     * @return void
     */
    public function handle(StoryCreated $event)
    {
         Mail::send(new newStoryNotification($event->title));
    }
}
