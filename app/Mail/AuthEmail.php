<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AuthEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $number;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $number)
    {
        $this->number = $number;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.verifyemail', ['code' => $this->number]);
    }
}
