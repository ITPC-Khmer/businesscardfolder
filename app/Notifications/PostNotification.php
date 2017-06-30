<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase()
    {
        return [
            'id' => 1,
            'title' => 'test',
            'data' => '2017-06-30',
        ];
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
