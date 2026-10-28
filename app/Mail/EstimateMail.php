<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;

class EstimateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $summary;
    public bool $forAdmin;

    /**
     * Create a new message instance.
     */
    public function __construct($summary, bool $forAdmin = false)
    {
        $this->summary = $summary;
        $this->forAdmin = $forAdmin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $senderEmail = $this->summary['recipient_email'] ?? null;
        $company     = $this->summary['company'] ?? null;
        $service     = $this->summary['serviceLabel'] ?? 'Ballpark Estimate';

        if ($this->forAdmin) {
            $fromName = $company ? "{$company} ({$senderEmail})" : ($senderEmail ? "Quote: {$senderEmail}" : config('mail.from.name', 'Waveron Quotes'));
            $companyStr = $company ? " ({$company})" : "";
            $subject = $senderEmail
                ? "New Ballpark Estimate Quote: {$senderEmail}{$companyStr} - {$service}"
                : "New Ballpark Estimate Quote - {$service}";

            $replyTo = [];
            if ($senderEmail && filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
                $replyTo[] = new Address($senderEmail, $company ?: $senderEmail);
            }

            return new Envelope(
                from: new Address(config('mail.from.address'), $fromName . ' via Waveron'),
                replyTo: $replyTo,
                subject: $subject,
            );
        }

        $replyToAddress = config('mail.to.address') ?: 'info@waverontechnologies.co.ke';

        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name', 'Waveron Technologies')),
            replyTo: [new Address($replyToAddress, config('mail.from.name', 'Waveron Technologies'))],
            subject: 'Waveron Technologies - Ballpark Estimate Summary',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.estimate',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
