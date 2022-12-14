<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductrevNotification extends Notification
{
    use Queueable;
    public $user;
    public  $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,  $product)
    {
        $this->user = $user;
        $this->product =  $product;
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
            'mesg'    => "Gave Review on Your Product",
            'request_id' => $this->product['id'],
            'link'       => "product.showproduct",
        ];
    }
}
