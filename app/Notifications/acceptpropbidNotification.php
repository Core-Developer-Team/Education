<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class acceptpropbidNotification extends Notification
{
    use Queueable;
    public $user;
    public $req;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$req)
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
            'user_id' => $this->user['id'],
            'name'    => $this->user['username'],
            'image'   => $this->user['image'],
            'mesg'    => "Accept Your Bid",
            'request_id' => $this->req['id'],
            'link'       => "proposal.showproposal",
        ];
    }
}
