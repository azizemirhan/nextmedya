<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ServiceRequestSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        $serviceType = \App\Models\ServiceRequest::$serviceTypes[$this->data['service_type']] ?? $this->data['service_type'];
        $packageType = $this->data['package_type'] ?? 'Özel';
        
        if (isset(\App\Models\ServiceRequest::$packageTypes[$packageType])) {
            $packageType = \App\Models\ServiceRequest::$packageTypes[$packageType];
        }

        return new Envelope(
            from: new Address(
                config('mail.from.address', 'noreply@nextmedya.com'),
                config('mail.from.name', 'Next Medya')
            ),
            replyTo: [
                new Address($this->data['email'], $this->data['name'])
            ],
            subject: '🎯 Yeni Hizmet Talebi: ' . $serviceType . ' - ' . $packageType,
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.service-request-submitted',
            text: 'emails.service-request-submitted-text',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}