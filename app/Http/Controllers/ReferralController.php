<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientReferral;
use App\Models\AuditLog;
use App\Mail\ReferralConfirmationMail;
use App\Mail\ReferralReceivedMail;
use Illuminate\Support\Facades\Mail;

class ReferralController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'referrer_name'         => 'required|string|max:255',
            'referrer_contact'      => 'required|string|max:255',
            'client_name'           => 'required|string|max:255',
            'client_contact_person' => 'nullable|string|max:255',
            'client_email'          => 'nullable|email|max:255',
            'client_phone'          => 'nullable|string|max:255',
            'services_needed'       => 'nullable|string|max:2000',
            'notes'                 => 'nullable|string|max:2000',
        ]);

        $code = ClientReferral::generateCode();

        $referral = ClientReferral::create([
            'referral_code'         => $code,
            'referrer_name'         => $validated['referrer_name'],
            'referrer_contact'      => $validated['referrer_contact'],
            'client_name'           => $validated['client_name'],
            'client_contact_person' => $validated['client_contact_person'] ?? null,
            'client_email'          => $validated['client_email'] ?? null,
            'client_phone'          => $validated['client_phone'] ?? null,
            'services_needed'       => $validated['services_needed'] ?? '',
            'notes'                 => $validated['notes'] ?? null,
            'commission_amount'     => 0,
            'payout_status'         => 'Pending',
            'status'                => 'Pending Review',
            'promoted_to_lead'      => false,
        ]);

        AuditLog::logAction(
            'Client Referral Submitted',
            "Referral {$code} submitted by {$referral->referrer_name} for {$referral->client_name}",
            'ClientReferral',
            $referral->id
        );

        // Attempt sending confirmation to referrer if they provided an email address
        if (filter_var($referral->referrer_contact, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($referral->referrer_contact)->send(new ReferralConfirmationMail($referral));
            } catch (\Throwable $e) {
                // Keep moving without breaking user submission
            }
        }

        // Attempt sending admin alert
        $adminEmail = config('mail.from.address') ?: 'admin@waverontechnologies.co.ke';
        try {
            Mail::to($adminEmail)->send(new ReferralReceivedMail($referral));
        } catch (\Throwable $e) {
            // Keep moving without breaking user submission
        }

        return redirect()->back()->with([
            'referral_success' => true,
            'referral_code'    => $code,
            'referrer_name'    => $referral->referrer_name,
            'client_name'      => $referral->client_name,
        ]);
    }
}
