<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $email = $this->data['email'] ?? null;
        $name = $this->data['name'] ?? 'User';
        $baseSubject = $this->data['subject'] ?? 'New Contact Form Submission';
        $subject = $email ? "{$baseSubject} - {$email}" : $baseSubject;
        $fromName = $email ? "{$name} ({$email}) via Waveron" : "{$name} via Waveron";

        return $this->from(config('mail.from.address'), $fromName)
                    ->subject($subject)
                    ->replyTo($email ?? config('mail.from.address'), $name)
                    ->markdown('emails.contact-form');
    }
}
