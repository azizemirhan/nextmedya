<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OutgoingMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailSubject;
    public $mailBody;

    public function __construct($subject, $body)
    {
        $this->mailSubject = $subject;
        $this->mailBody = $body;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mailSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.outgoing-message',
        );
    }
}
