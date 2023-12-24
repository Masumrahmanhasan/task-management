<?php

namespace App\Jobs;

use App\Notifications\NewRegistrationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNewRegistrationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $user)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new NewRegistrationNotification());
    }
}
