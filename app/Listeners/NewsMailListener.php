<?php

namespace App\Listeners;

use App\Events\NewsCreatedEvent;
use App\Mail\NewsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewsMailListener
{
    /**
     * Handle the event.
     *
     * @param  NewsCreatedEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $extra = $event->getData();
        dump('EVENT THROWN');
        /*Mail::to(env('ADMIN_MAIL'))
            ->send(new NewsMail($extra));*/
    }
}
