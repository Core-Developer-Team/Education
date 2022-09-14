<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class CommentNotification extends Notification
{
    use Queueable;
    public $user;
    public $req;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $req)
    {
        $this->user = $user;
        $this->req = $req;
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
            'request_id' => $this->req['id'],
            'user_id'    => $this->user['id'],
            'name'       => $this->user['username'],
            'image'      => $this->user['image'],
            'mesg'       => "comment on Your Request",
            'link'       => "req.showsingle",
        ];
    }
}
