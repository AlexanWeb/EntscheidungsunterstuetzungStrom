<?php

namespace App\Listeners\Auth;

use App\Mail\Auth\ActivationEmail;
use App\Models\ConfirmationToken;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendActivationEmail
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->user)->send(new ActivationEmail($event->user->generateConfirmationToken()));
    }
}
