<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookrevNotification extends Notification
{
    use Queueable;
    public $user;
    public $book;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$book)
    {
        $this->user = $user;
        $this->book = $book;
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
            'user_id'    => $this->user['id'],
            'name'       => $this->user['username'],
            'image'      => $this->user['image'],
            'mesg'       => "Gave Review on Your Book",
            'request_id' => $this->book['id'],
            'link'       => "books.showbook",
        ];
    }
}
