<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserRegisteredEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject($this->title)
            ->view('emails.new_user_registered')
            ->with('content', $this->content);
    }
}
