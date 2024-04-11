<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $token;
    public $Password;
    /**
     * Create a new message instance.
     */
    public function __construct($name,$token,$Password)
    {
        $this->name = $name;
        $this->token = $token;
        $this->Password=$Password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail',
        );
    }


    public function build()
    {
        $user['name'] = $this->name;
        $user['token'] = $this->token;
        $user['Password']=$this->Password;
        return $this->from("yoursenderemail@mail.com", "Sender Name")
        ->subject('Acoount Information')
        ->view('Account.Account', ['user' => $user]);
    }
}
