<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PrevNotification extends Notification
{
    use Queueable;
    public $user;
    public $prorev;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $prorev)
    {
        $this->user = $user;
        $this->prorev = $prorev;
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
            'request_id' => $this->prorev['id'],
            'link'       => "proposal.showproposal",
        ];
    }
}
