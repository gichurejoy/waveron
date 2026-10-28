<?php

namespace App\Mail;

use App\Models\QuoteSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;

class QuoteEstimateGeneratedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public QuoteSubmission $quote
    ) {}

    public function envelope(): Envelope
    {
        $replyToAddress = config('mail.to.address') ?: 'info@waverontechnologies.co.ke';

        return new Envelope(
            subject: "Official Quote Estimate #{$this->quote->id} - Waveron Technologies",
            replyTo: [
                new Address($replyToAddress, config('mail.from.name', 'Waveron Technologies')),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quote-estimate',
            with: [
                'quote' => $this->quote,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
