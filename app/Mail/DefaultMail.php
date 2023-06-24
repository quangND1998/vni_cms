<?php

namespace App\Mail;

use App\Models\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class DefaultMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mail;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, Mail $mail)
    {
        $this->user = $user;
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $mail = $this->mail;
        
        return $this->view('mail.default', compact('mail', 'user'))->subject("[Nemoviz] " . $mail->title)->from("quang10031998@gmail.com", "Nemoviz");
    }
}
