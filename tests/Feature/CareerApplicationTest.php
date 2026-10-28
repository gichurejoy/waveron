<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\JobApplicationMail;
use Tests\TestCase;

class CareerApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_candidate_application_sends_email_with_sender_email_in_envelope(): void
    {
        Mail::fake();
        Storage::fake('public');

        $resume = UploadedFile::fake()->create('resume.pdf', 500, 'application/pdf');

        $payload = [
            'name'          => 'Jane Doe',
            'contact'       => 'jane.doe@example.com',
            'years_exp'     => 4,
            'why_fit'       => 'Strong sales and tech background.',
            'largest_deal'  => 'Closed a $200k SaaS deal.',
            'proud_sale'    => 'Transformed an enterprise pipeline.',
            'first_clients' => 'Target local FinTech companies.',
            'resume'        => $resume,
        ];

        $response = $this->post(route('careers.submit'), $payload);

        $response->assertSessionHas('success');

        Mail::assertSent(JobApplicationMail::class, function (JobApplicationMail $mail) {
            $envelope = $mail->envelope();

            $hasReplyTo = collect($envelope->replyTo)->contains(fn ($addr) => $addr->address === 'jane.doe@example.com');
            $hasSenderInSubject = str_contains($envelope->subject, 'jane.doe@example.com');
            $hasSenderInFromName = str_contains($envelope->from->name, 'jane.doe@example.com');

            return $hasReplyTo && $hasSenderInSubject && $hasSenderInFromName;
        });
    }
}
