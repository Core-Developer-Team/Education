<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SolreportNotification extends Notification
{
    use Queueable;
    public $user;
    public $req;
    public $touser;
    public $remesg;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $remesg, $req, $touser)
    {
        $this->user = $user;
        $this->req = $req;
        $this->touser = $touser;
        $this->remesg = $remesg;
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
            'remesg'     => $this->remesg,
            'mesg'       => "Report on ".$this->touser['username']." Solution",
            'link'       => "req.showsingle",
        ];
    }
}
