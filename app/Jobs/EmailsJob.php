<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $emailClass;
    /**
     * @var array
     */
    private $args;
    /**
     * EmailsJob constructor.
     * @param string $email
     * @param string $emailClass
     * @param array $args
     */
    public function __construct($email,$emailClass,$args = [])
    {
        $this->email = $email;
        $this->emailClass = $emailClass;
        $this->args = $args;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new $this->emailClass($this->args));
    }
}
