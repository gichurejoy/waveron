<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceSentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Invoice $invoice,
        public ?string $pdfContent = null
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Invoice Statement {$this->invoice->invoice_number} - Waveron Technologies",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice-sent',
            with: [
                'invoice' => $this->invoice,
            ]
        );
    }

    public function attachments(): array
    {
        if ($this->pdfContent) {
            return [
                Attachment::fromData(
                    fn () => $this->pdfContent,
                    "Statement_{$this->invoice->invoice_number}.pdf"
                )->withMime('application/pdf'),
            ];
        }

        return [];
    }
}
