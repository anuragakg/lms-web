<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ForgotPassword extends Notification
{
    use Queueable;

    public $_channels = [];
    public $_options = [];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($_options = [])
    {
        $this->_options = $_options;
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
        $url = env('WEB_URL') . '/reset-password.php?token=' . $this->_options['token'];
        return (new MailMessage)
            ->subject('Reset Password,'.env('APP_NAME'))
            ->line('Dear Sir/Madam,')
            ->greeting('Greetings!!,')
            ->line('You have requested to reset your password. Please click on  below link to reset your password.')
            ->action('Reset Password', $url)
            ->line('Thanks & Regards')
            ->line(env('APP_NAME'));
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
