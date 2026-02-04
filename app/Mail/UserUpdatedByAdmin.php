<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserUpdatedByAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $admin;
    public $passwordChanged;

    public function __construct($user, $admin, $passwordChanged = false)
    {
        $this->user = $user;
        $this->admin = $admin;
        $this->passwordChanged = $passwordChanged;
    }

    public function build()
    {
        return $this->subject('Your account details were updated')
            ->view('emails.user_updated_by_admin');
    }
}
