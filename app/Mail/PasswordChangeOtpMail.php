<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordChangeOtpMail extends Mailable
{
    use SerializesModels;

    public $otp;


    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('Password Change OTP')
            ->view('users.password_change_mail_template')
            ->with([
                'otp' => $this->otp,
            ]);
    }
}
