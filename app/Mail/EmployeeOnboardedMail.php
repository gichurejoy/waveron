<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeOnboardedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $employee,
        public string $temporaryPassword,
        public ?string $roleTitle = null
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Welcome to Waveron Technologies - Your Team Account & Credentials",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.employee-onboarded',
            with: [
                'employee'          => $this->employee,
                'temporaryPassword' => $this->temporaryPassword,
                'roleTitle'         => $this->roleTitle ?? $this->employee->role,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
