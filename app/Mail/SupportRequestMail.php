<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($formData)
    {
        $this->data = $formData;
    }

    public function build()
    {
        return $this->from('admin@nextmedya.com', 'Next Medya')
                    ->to('info@nextmedya.com')
                    ->subject('Yeni Müşteri Talebi')
                    ->view('emails.support-request')
                    ->with('data', $this->data);
    }
}

