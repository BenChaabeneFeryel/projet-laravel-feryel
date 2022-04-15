<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Notifications\Notification;
class SendNewUserNotification
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $admins = User::where('id',1)->get();

        Notification::send($admins, new NewUserNotification($event->user));
    }
}
