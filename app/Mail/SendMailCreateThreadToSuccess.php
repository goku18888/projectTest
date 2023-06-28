<?php
 
 namespace App\Mail;

use App\Models\customers;
use App\Models\threads;
use Illuminate\Bus\Queueable;
 use Illuminate\Mail\Mailable;
 use Illuminate\Queue\SerializesModels;
 use Illuminate\Contracts\Queue\ShouldQueue;
 
 class SendMailCreateThreadToSuccess extends Mailable
 {
     use Queueable, SerializesModels;
     public $user;
     public $thread;
     
     /**
      * Create a new message instance.
      *
      * @return void
      */
     public function __construct(customers $user, threads $thread)
     {
    
         $this->customers = $user;
         $this->thread = $thread;
     }
 
     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
         return $this->view('cilent.thread.sendMailCreateThreadToSuccess')
                     ->from('buinghia2803@gmail.com', 'nghia')
                     ->subject('A new contact email')
                     ->with('thread',$this->thread);
     }
 }