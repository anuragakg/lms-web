<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
	 public $title;
    public function __construct($product)
    {
        $this->title=$product->title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->subject('New Product Form Added')
                    ->greeting('Hello '.$notifiable->name)
                    ->line('A new Product Form has been added. ')
                    ->line('Title : '.$this->title)
                    ->action('Notification Action', env('WEB_URL').'/new-form-list.php')
                    ->line('Please check and update the status')
                    ->line('Thanks');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $title=$this->title;
        return [
            'message'=>"A new Product Form $title has been added.Please check and update status",
            'action' => env('WEB_URL').'/new-form-list.php'
        ];
    }
}
