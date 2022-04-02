<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendUserInstallments extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $payment;
    public function __construct($payment)
    {
        $this->payment=$payment;
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
        $lead_user=$this->payment->getLeadUser->name;
        $program=$this->payment->getProgramInfo->title;
        $installments=$this->payment->getInstallments;
        $message= (new MailMessage);
        $message->greeting("Hello ".ucfirst($lead_user));
        $message->line("You have been enrolled for a Programme $program");
        $message->line('Your installments amount and due dates are given below.');
        foreach ($installments as $key => $installment) {
            $message->line('Date : '.$installment->installment_date .' Amount : '.$installment->installment_amount);
        }
        $message->line('Kindly pay all installment on or before the due date');
        return $message;
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
