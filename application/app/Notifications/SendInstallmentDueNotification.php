<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendInstallmentDueNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $payment;
    private $instalment;
    public function __construct($payment,$instalment)
    {
        $this->payment=$payment;
        $this->instalment=$instalment;
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
        $program=$this->payment->getProgramInfo->title;
        $lead_user=$this->payment->getLeadUser->name;
        $installment_amount=$this->instalment->installment_amount;
        $installment_date=date('d-M-Y',strtotime($this->instalment->installment_date));
        $message= (new MailMessage);
        $message->Subject("Installament due of Rs.$installment_amount  on $installment_date for programmer $program");
        $message->greeting("Hello ".ucfirst($lead_user));
        $message->line("You installment is due of Rs.$installment_amount  on $installment_date for programmer $program");
        $message->line("Kindly Pay your installment on time. Please ignore if alread done");
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
