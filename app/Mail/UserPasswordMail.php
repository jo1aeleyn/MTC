<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class UserPasswordMail extends Mailable
{
    public $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function build()
    {
        return $this->view('emails.user_password')
                    ->with(['password' => $this->password]);
    }
}
