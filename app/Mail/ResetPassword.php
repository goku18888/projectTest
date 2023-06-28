<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$token)
    {
        $this->name_admin = $name;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $admin['name_admin'] = $this->name_admin;
        $admin['token'] = $this->token;

        return $this->from("hoctap438@mail.com", "SHOP BÁN ĐIỆN THOẠI")
        ->subject('Password Reset Link')
        ->view('admin.template.reset-password', ['admin' => $admin]);
    }
}
