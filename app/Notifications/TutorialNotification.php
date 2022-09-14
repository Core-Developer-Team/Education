<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TutorialNotification extends Notification
{
    use Queueable;
    public $user;
    public  $tutorial;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user ,  $tutorial)
    {
        $this->user = $user;
        $this->tutorial =  $tutorial;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->user['id'],
            'name'    => $this->user['username'],
            'image'   => $this->user['image'],
            'mesg'    => "Give Review on Your Tutorial",
            'request_id' => $this->tutorial['id'],
            'link'       => "tutorial.sin",
        ];
    }
}
