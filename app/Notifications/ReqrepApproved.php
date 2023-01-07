<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReqrepApproved extends Notification
{
    use Queueable;

    public $usr;
    public $req;
    public $tuser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($usr, $req, $tuser)
    {
        $this->user = $usr;
        $this->req = $req;
        $this->touser = $tuser;
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
            'request_id' => $this->req['request_id'],
            'user_id'    => $this->user['id'],
            'name'       => $this->user['username'],
            'image'      => $this->user['image'],
            'mesg'       => "Approved Report on Your Solution",
            'link'       => "req.showsingle",
        ];
    }
}
