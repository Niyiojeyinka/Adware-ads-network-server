<?php

namespace App\Listeners;

use App\Mail\SendPasswordRecoveryMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserPasswordRecoveryMail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        //
    }
*/
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->data['user']->email)->send(new SendPasswordRecoveryMail($event->data));
    }
}
