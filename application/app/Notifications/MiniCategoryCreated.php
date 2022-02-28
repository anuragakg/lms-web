<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MiniCategoryCreated extends Notification
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
        //$this->title=$product->title;
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
                    ->subject('New Product Mini Category Added')
                    ->greeting('Hello '.$notifiable->name)
                    ->line('A new Product Mini Category has been added. ')
                    //->line('Title : '.$this->title)
                    ->action('Notification Action', env('WEB_URL').'/product-mini-category-list.php?form_type=1')
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
        return [
            'message'=>"A new Product Category has been added.Please check and update status",
            'action' => env('WEB_URL').'/product-mini-category-list.php?form_type=1'
        ];
    }
}
