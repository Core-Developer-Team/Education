<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PsolNotification extends Notification
{
    use Queueable;
    public $user;
    public $proposal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $proposal)
    {
        $this->user = $user;
        $this->proposal = $proposal;
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
            'mesg'    => "gave Solution on Your Proposal",
            'request_id' => $this->proposal['id'],
            'link'       => "proposal.showproposal",
        ];
    }
}
