<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

use Illuminate\Mail\Mailables\Address;

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
        $contact = trim($this->applicationData['contact'] ?? '');
        $applicantEmail = null;
        if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            $applicantEmail = $contact;
        } elseif (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $contact, $matches)) {
            $applicantEmail = $matches[0];
        }

        $applicantName = trim($this->applicationData['name'] ?? 'Candidate');

        $fromName = $applicantName;
        if ($applicantEmail) {
            $fromName .= " ({$applicantEmail})";
        } elseif ($contact !== '') {
            $fromName .= " ({$contact})";
        }
        $fromName .= ' via Waveron Careers';

        $subjectSuffix = $applicantEmail ? " [{$applicantEmail}]" : ($contact !== '' ? " [{$contact}]" : '');
        $subject = 'New Job Application - ' . $applicantName . $subjectSuffix;

        $replyTo = [];
        if ($applicantEmail) {
            $replyTo[] = new Address($applicantEmail, $applicantName);
        }

        return new Envelope(
            from: new Address(config('mail.from.address'), $fromName),
            replyTo: $replyTo,
            subject: $subject,
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
