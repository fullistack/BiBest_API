<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class StudentRegisterConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    private $args;

    /**
     * StudentRegisterConfirm constructor.
     * @param array $args
     */
    public function __construct($args = [])
    {
        $this->args = $args;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->args['url'] = 'http://usoundeddev.workteamhtml.link/'.App::getLocale().'/auth/confirm?token='.$this->args['token'];
        return $this->view('emails.student_register_confirm',$this->args);
    }
}
