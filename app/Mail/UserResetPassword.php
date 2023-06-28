<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$token)
    {
        $this->name_customer = $name;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['name_customer'] = $this->name_customer;
        $user['token'] = $this->token;

        return $this->from("hoctap438@mail.com", "Admin")
        ->subject('Password Reset Link')
        ->view('cilent.template.reset-password', ['user' => $user]);
    }
}
