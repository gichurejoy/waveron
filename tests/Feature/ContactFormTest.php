<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_sends_email_with_sender_email_in_envelope(): void
    {
        Mail::fake();

        $payload = [
            'name'     => 'Alex Smith',
            'email'    => 'alex.smith@example.com',
            'subject'  => 'Need Custom Cloud Architecture',
            'message'  => 'Hello, we would like a custom quote for our cloud migration.',
            'company'  => 'Smith Tech Ltd',
        ];

        $response = $this->post(route('contact.submit'), $payload);

        $response->assertSessionHas('success');

        Mail::assertSent(ContactFormMail::class, function (ContactFormMail $mail) {
            $built = $mail->build();

            $hasReplyTo = collect($built->replyTo)->contains(fn ($addr) => ($addr['address'] ?? null) === 'alex.smith@example.com');
            $hasSenderInSubject = str_contains($built->subject, 'alex.smith@example.com');
            $hasSenderInFromName = str_contains($built->from[0]['name'] ?? '', 'alex.smith@example.com');

            return $hasReplyTo && $hasSenderInSubject && $hasSenderInFromName;
        });
    }

    public function test_fast_inquiry_sends_email_with_sender_email_in_envelope(): void
    {
        Mail::fake();

        $payload = [
            'name'     => 'Sarah Connor',
            'email'    => 'sarah.connor@example.com',
            'company'  => 'Resistance Corp',
            'message'  => 'Urgent AI audit required.',
        ];

        $response = $this->post(route('quote.fast-inquiry'), $payload);

        $response->assertSessionHas('success');

        Mail::assertSent(ContactFormMail::class, function (ContactFormMail $mail) {
            $built = $mail->build();

            $hasReplyTo = collect($built->replyTo)->contains(fn ($addr) => ($addr['address'] ?? null) === 'sarah.connor@example.com');
            $hasSenderInSubject = str_contains($built->subject, 'sarah.connor@example.com');
            $hasSenderInFromName = str_contains($built->from[0]['name'] ?? '', 'sarah.connor@example.com');

            return $hasReplyTo && $hasSenderInSubject && $hasSenderInFromName;
        });
    }
}
