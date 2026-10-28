<?php

namespace App\Mail;

use App\Models\ClientReferral;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferralConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ClientReferral $referral
    ) {}

    public function build()
    {
        return $this->from(config('mail.from.address'), 'Waveron Technologies Partnerships')
            ->subject("Referral Received! Your Tracking Code: {$this->referral->referral_code}")
            ->view('emails.referral-confirmation', [
                'referral' => $this->referral,
            ]);
    }
}
