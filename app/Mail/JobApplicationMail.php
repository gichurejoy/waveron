<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class JobApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicationData;
    public $resumeFile;

    public function __construct($data, $resumeFile)
    {
        $this->applicationData = $data;
        $this->resumeFile = $resumeFile;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Salesperson Application - ' . $this->applicationData['name'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.job_application',
            with: ['data' => $this->applicationData],
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->resumeFile->getRealPath())
                ->as($this->resumeFile->getClientOriginalName())
                ->withMime($this->resumeFile->getMimeType()),
        ];
    }
}
