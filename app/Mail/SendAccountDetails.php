<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAccountDetails extends Mailable
{
    use SerializesModels;

    public $username;
    public $password;

    /**
     * Create a new message instance.
     *
     * @param  string  $username
     * @param  string  $password
     * @return void
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Account Details')->view('emails.account_details');
    }
}

