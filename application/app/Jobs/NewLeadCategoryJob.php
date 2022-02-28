<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewLeadCategory;
use App\Models\User;
class NewLeadCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
	private $product;
    public function __construct($product)
    {
        $this->product=$product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$users=User::whereIn('role',['2','3','4'])->get();
        Notification::send($users, new NewLeadCategory($this->product));
    }
}
