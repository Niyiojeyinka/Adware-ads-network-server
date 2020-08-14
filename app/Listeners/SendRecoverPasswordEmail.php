<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\RecoverPasswordMail;
use App\User as User;
use App\Events\UserForgetPassword;

class SendRecoverPasswordEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserForgetPassword $event)
    {
        Mail::to($event->data['email'])->send(
            new RecoverPasswordMail($event->data)
        );
    }
}
