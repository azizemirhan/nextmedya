<?php

// app/Mail/ContactSubmitted.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function build()
    {
        return $this->subject('Yeni İletişim Mesajı: ' . $this->payload['subject'])
            ->replyTo($this->payload['email'], $this->payload['name'])
            ->markdown('mail.contact-submitted');
    }
}
