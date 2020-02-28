<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsMail extends Mailable
{
    use Queueable, SerializesModels;

    private $mailData = [];

    /**
     * Create a new message instance.
     *
     * @param $mailData
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // send news-feed mail
        return $this->markdown('emails.newsfeed', $this->mailData);
    }
}
