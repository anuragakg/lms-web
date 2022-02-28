<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubCategoryCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $sub_category;
    public function __construct($product)
    {
        $this->sub_category=$product->sub_category;
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
                    ->subject('New Product Sub Category Added')
                    ->greeting('Hello '.$notifiable->name)
                    ->line('A new Product Category has been added. ')
                    ->line('Title : '.$this->sub_category)
                    ->action('Notification Action', env('WEB_URL').'/product-sub-category-list.php')
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
        $sub_category=$this->sub_category;
        return [
            'message'=>"A new Product Sub Category $sub_category has been added.Please check and update status",
            'action' => env('WEB_URL').'/product-sub-category-list.php'
        ];
    }
}
