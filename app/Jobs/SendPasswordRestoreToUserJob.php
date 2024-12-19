<?php

namespace App\Jobs;

use App\Mail\SendRestorePasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendPasswordRestoreToUserJob implements ShouldQueue
{
    use Queueable;

    private $email;
    private $token;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new SendRestorePasswordMail($this->token));
    }
}
