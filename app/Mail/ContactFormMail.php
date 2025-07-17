<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;
    /**
     * Create a new message instance.
     */
    public function __construct($formData){
        $this->formData = $formData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(replace_shortcodes('[email-form-submission]'), 'Swizchem'),
            replyTo: [
                new Address(replace_shortcodes('[email-form-submission]'), 'Swizchem'),
            ],
            subject: 'New Contact Form Submission',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
        view: 'mails.contact',
        with: [
            'name'    => $this->formData['name'],
            'email'   => $this->formData['email'],
            'phone'   => $this->formData['phone'] ?? '',
            'bodyMessage' => $this->formData['message'] ?? '',
        ],
    );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
