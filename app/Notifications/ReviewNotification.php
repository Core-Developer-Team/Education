<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewNotification extends Notification
{
    use Queueable;
    public $user;
    public $reqrev;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $reqrev)
    {
        $this->user = $user;
        $this->reqrev = $reqrev;
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
            'mesg'    => "Gave review on Your Solution",
            'request_id' => $this->reqrev['id'],
            'link'       => "req.showsingle",
        ];
    }
}
