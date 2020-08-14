<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoverPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'noreply@adware.com';
        $subject = 'Forgot Password';
        $name = 'Adware';

        return $this->view('mails.forget_password')
            ->from($address, $name)
            ->subject($subject)
            ->with([
                'token' => $this->data['token'],
                'name' => $this->data['name'],
            ]);
    }
}
