<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('mail@example.com', 'Mailtrap')->subject('Password Updated')->markdown('emails.account.password.updated');
    }
}
