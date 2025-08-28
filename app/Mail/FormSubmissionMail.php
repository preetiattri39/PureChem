<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class FormSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The form data.
     *
     * @var array
     */
    public $formData;

    /**
     * The view for the email content.
     *
     * @var string
     */
    public $view;

    /**
     * Create a new message instance.
     *
     * @param array $formData
     * @param string $view
     * @return void
     */
    public function __construct(array $formData, string $view)
    {
        $this->formData = $formData;
        $this->view = $view;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(replace_shortcodes('[email-form-submission]'), 'Swizchem'),
            replyTo: [
                new Address(replace_shortcodes('[email-form-submission]'), 'Swizchem'),
            ],
            subject: $this->formData['subject'] ?? 'New Form Submission',
        );
    }
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: $this->view,
            with: $this->formData,
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