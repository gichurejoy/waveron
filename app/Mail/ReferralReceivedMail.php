<?php

namespace App\Mail;

use App\Models\ClientReferral;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferralReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ClientReferral $referral
    ) {}

    public function build()
    {
        return $this->from(config('mail.from.address'), 'Waveron Referral System')
            ->subject("New Client Referral [{$this->referral->referral_code}]: {$this->referral->client_name}")
            ->view('emails.referral-received', [
                'referral' => $this->referral,
            ]);
    }
}
