<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ContactUsMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var array<string, string>
     */
    public array $contactData;
    public $attachmentsPath;

    /**
     * @param array<string, string> $contactData
     */
    public function __construct(array $contactData,$attachmentsPath = null)
    {
        $this->contactData = $contactData;
        $this->attachmentsPath = $attachmentsPath;

    }
    public function build(): ContactUsMail
    {
        $email = $this->view('mail.contact-us-mail')
            ->subject('Contact Form Submission')
            ->with('data', $this->contactData);
        if ($this->attachmentsPath) {
            $email->attach(
                Attachment::fromPath(Storage::disk('public')->path($this->attachmentsPath))
            );
        }

        return $email;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = 'new data' . $this->contactData['name'];

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.contact-us-mail',
            with: [
                'contactData' => $this->contactData,
            ]
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
