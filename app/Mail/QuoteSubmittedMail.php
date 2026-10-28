<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;

class QuoteSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quote;

    /**
     * Create a new message instance.
     */
    public function __construct($quote)
    {
        $this->quote = $quote;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $email = $this->quote->contact_email ?? null;
        $name = $this->quote->contact_name ?? 'Client';
        $quoteNum = $this->quote->quote_number ?? '';

        $subject = "New Quote Submitted: {$quoteNum}";
        if ($email) {
            $subject .= " - {$email}";
        }

        $fromName = $email ? "{$name} ({$email}) via Waveron" : "{$name} via Waveron";

        $replyTo = [];
        if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $replyTo[] = new Address($email, $name);
        }

        return new Envelope(
            from: new Address(config('mail.from.address'), $fromName),
            replyTo: $replyTo,
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.quote-submitted',
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
