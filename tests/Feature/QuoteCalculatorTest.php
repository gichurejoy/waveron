<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\EstimateMail;
use App\Models\QuoteSubmission;
use Tests\TestCase;

class QuoteCalculatorTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_estimate_validation_fails_on_missing_fields(): void
    {
        $response = $this->postJson(route('quote.email-estimate'), []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'summary']);
    }

    public function test_email_estimate_successfully_creates_quote_submission_and_sends_email(): void
    {
        Mail::fake();

        $payload = [
            'email' => 'client@example.com',
            'company' => 'Apex Enterprises',
            'summary' => [
                'serviceLabel' => 'Software Development (web/app platforms)',
                'complexityLabel' => 'Advanced Platform',
                'timelineLabel' => '2 - 3 Months',
                'features' => 3,
                'selectedFeatures' => ['Real-Time Live WebSockets', 'Custom AI Model Integration'],
                'addonNames' => ['Continuous Security Auditing'],
                'total' => 1850000,
                'monthly' => 0,
                'addonTotal' => 25000,
                'featureAdj' => 1.0,
            ],
        ];

        $response = $this->postJson(route('quote.email-estimate'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Estimate has been emailed successfully!',
        ]);

        $this->assertDatabaseHas('quote_submissions', [
            'user_email' => 'client@example.com',
            'company' => 'Apex Enterprises',
            'estimated_total' => 1850000,
            'status' => 'New',
        ]);

        Mail::assertSent(EstimateMail::class, 2); // Sent to info and client

        Mail::assertSent(EstimateMail::class, function (EstimateMail $mail) {
            if ($mail->forAdmin) {
                $envelope = $mail->envelope();
                $hasReplyTo = collect($envelope->replyTo)->contains(fn ($addr) => $addr->address === 'client@example.com');
                $hasSenderInSubject = str_contains($envelope->subject, 'client@example.com');
                $hasSenderInFromName = str_contains($envelope->from->name, 'client@example.com');

                return $hasReplyTo && $hasSenderInSubject && $hasSenderInFromName;
            }
            return false;
        });
    }
}
