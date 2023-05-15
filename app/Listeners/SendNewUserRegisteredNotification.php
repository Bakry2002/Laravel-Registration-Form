<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Mail\NewUserRegisteredEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewUserRegisteredNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(NewUserRegistered $event)
    {
        $title = 'New registered user';
        $content = "A new user < {$event->student->Username} > is registered to the system.";

        Mail::to('abdaullah62@gmail.com')->send(new NewUserRegisteredEmail($title, $content));
    }
}
