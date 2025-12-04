<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendCustomEmailJob implements ShouldQueue
{
    use Queueable;
    public $receiverEmail;
    public $subject;
    public $body;

    public function __construct($receiverEmail, $subject, $body)
    {
        $this->receiverEmail = $receiverEmail;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // PLAIN TEXT VERSION
        Mail::raw($this->body, function ($message) {
            $message->to($this->receiverEmail)
                    ->subject($this->subject);
        });

        // Mail::html($this->body, function ($message) { ... });
    }
}
