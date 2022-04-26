<?php
namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Mail\newStoryNotification;
use Illuminate\Support\Facades\Log;

class storyEventSubscriber{


    public function handleStoryCreated($event){
        Log::info("A new story was added with title from subscriber".$event->title);
         
    }

    public function handleStoryEdited($event){
        
       Log::info("A new story was added with title from subscriber".$event->title);
}

    public function subscribe($events){

        $events->listen(
            'App\Events\StoryCreated',
            'App\Listeners\storyEventSubscriber@handleStoryCreated'
        );

        $events->listen(
            'App\Events\StoryEdited',
            'App\Listeners\storyEventSubscriber@handleStoryEdited'
        );
    }
}