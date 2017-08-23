<?php

namespace App\Listeners;

use App\Modules\Users\Events\NewUserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMessageListener
{

    public function __construct()
    {
        //
    }

    public function handle(NewUserEvent $event)
    {
        $user = $event->user;
    }
}
