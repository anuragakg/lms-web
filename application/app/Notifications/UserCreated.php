<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreated extends Notification implements ShouldQueue
{
    use Queueable;
	public $name;
	public $password;
	public $email;
	public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$password)
    {
		//$this->afterCommit();

        $this->user=$user;
        $this->name=$user->name;
        $this->password=$password;
        $this->email=$user->email;
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
					
					->subject('Registration Successfully')
                    ->greeting("Hi ".$this->name)
                    ->line('You have been successfully registered in our application.Your login credentials are given as below.')
					->line("Username : ".$this->email)
					->line("Username : ".$this->password)
                    ->action('Notification Action', env('WEB_URL'))
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
            'message'=>"You have been successfully registered in our application.You can change your password here",
			'action' => env('WEB_URL').'/change-password.php'
        ];
    }
}
