<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class MeetingRequestSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        $topic = \App\Models\MeetingRequest::$topics[$this->data['topic']] ?? $this->data['topic'];
        $date = \Carbon\Carbon::parse($this->data['preferred_date'])->format('d.m.Y');

        return new Envelope(
            from: new Address(
                config('mail.from.address', 'noreply@nextmedya.com'),
                config('mail.from.name', 'Next Medya')
            ),
            replyTo: [
                new Address($this->data['email'], $this->data['name'])
            ],
            subject: '📅 Yeni Toplantı Talebi: ' . $topic . ' - ' . $date,
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.meeting-request-submitted',
            text: 'emails.meeting-request-submitted-text',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}