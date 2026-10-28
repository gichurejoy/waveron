<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidateStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public JobApplication $application,
        public string $status
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Application Update: {$this->status} - Waveron Technical Careers",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.candidate-status',
            with: [
                'application' => $this->application,
                'status'      => $this->status,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
