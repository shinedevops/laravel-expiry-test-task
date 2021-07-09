<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class LoginRequest extends Notification
{
    use Queueable;

    public $accept_request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $accept_request = null )
    {
        $this->accept_request = $accept_request;
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
        if( empty($this->accept_request) ){
            return (new MailMessage)
            ->line('Your login request is rejected.')
            ->line('Thank you for using our application!');
        }
        return (new MailMessage)
        ->line('Your login request is accepted.')
        ->action('Login Link', route("login_with_token", Crypt::encryptString($this->accept_request->id) ) )
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
