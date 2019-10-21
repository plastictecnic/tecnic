<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendUserPassword extends Notification
{
    use Queueable;

    private $randomString;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($randomString)
    {
        $this->randomString = $randomString;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('This your application password.')
                    ->line('Password: ' . $this->randomString)
                    ->line('Login at : <a target="_blank" href="https://ptis.plastictecnic.com">Plastictecnic (M) Sdn. Bhd.</a>')
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
