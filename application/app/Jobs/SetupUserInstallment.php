<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Lead;
use App\Notifications\SendUserInstallments;
use Illuminate\Support\Facades\Notification;

class SetupUserInstallment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $payment;

    public function __construct($Payment)
    {
        $this->payment=$Payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $Payment=$this->payment;
        Notification::route('mail', [
            $Payment->getLeadUser->email => $Payment->getLeadUser->name,
        ])->notify(new SendUserInstallments($Payment));
    }
}
