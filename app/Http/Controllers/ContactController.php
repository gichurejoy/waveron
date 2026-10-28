<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Mail\EstimateMail;
use App\Models\ContactSubmission;
use App\Models\QuoteSubmission;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'subject'  => 'required|string|max:255',
            'message'  => 'required|string',
            'company'  => 'nullable|string|max:255',
            'budget'   => 'nullable|string|max:255',
            'timeline' => 'nullable|string|max:255',
            'services' => 'nullable|string|max:255',
        ]);

        try {
            // Save to database for admin dashboard
            ContactSubmission::create([
                'full_name' => $validated['name'],
                'email'     => $validated['email'],
                'company'   => $validated['company'] ?? null,
                'subject'   => $validated['subject'],
                'message'   => $validated['message'],
                'budget'    => $validated['budget'] ?? null,
                'timeline'  => $validated['timeline'] ?? null,
                'services'  => $validated['services'] ?? null,
                'status'    => 'Unread',
            ]);

            // Send email
            Mail::to(config('mail.to.address'))->send(new ContactFormMail($validated));

            // Return with success message
            return back()->with('success', 'Thank you for your message. We will get back to you soon!');
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            \Log::error($e->getTraceAsString());

            return back()->with('error', 'Sorry, there was an error sending your message. Please try again later.')
                        ->withInput();
        }
    }

    public function emailEstimate(Request $request)
    {
        $validated = $request->validate([
            'email'                    => 'required|email',
            'company'                  => 'nullable|string|max:255',
            'summary'                  => 'required|array',
            'summary.serviceLabel'     => 'required|string',
            'summary.complexityLabel'  => 'required|string',
            'summary.timelineLabel'    => 'required|string',
            'summary.features'         => 'required',
            'summary.selectedFeatures' => 'nullable|array',
            'summary.addonNames'       => 'nullable|array',
            'summary.total'            => 'required',
            'summary.monthly'          => 'required',
            'summary.addonTotal'       => 'nullable',
            'summary.featureAdj'       => 'nullable',
        ]);

        $email   = $validated['email'];
        $company = $validated['company'] ?? null;
        $summary = $validated['summary'];
        $summary['recipient_email'] = $email;
        if ($company) {
            $summary['company'] = $company;
        }

        try {
            // Save to database for admin dashboard
            QuoteSubmission::create([
                'service_type'      => $summary['serviceLabel'],
                'complexity'        => $summary['complexityLabel'],
                'timeline'          => $summary['timelineLabel'],
                'selected_features' => $summary['selectedFeatures'] ?? [],
                'selected_addons'   => $summary['addonNames'] ?? [],
                'estimated_total'   => (int) ($summary['total'] ?? 0),
                'user_email'        => $email,
                'company'           => $company,
                'status'            => 'New',
            ]);

            // Send directly to admin with forAdmin = true
            $adminEmail = config('mail.to.address') ?: 'info@waverontechnologies.co.ke';
            Mail::to($adminEmail)->send(new EstimateMail($summary, true));

            // Also send a copy directly to the user
            Mail::to($email)->send(new EstimateMail($summary, false));

            return response()->json([
                'success' => true,
                'message' => 'Estimate has been emailed successfully!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Estimate email error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return response()->json([
                'success' => false,
                'message' => 'Could not send the email. Please try again later.'
            ], 500);
        }
    }

    public function submitFastInquiry(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'company'  => 'nullable|string|max:255',
            'budget'   => 'nullable|string|max:255',
            'timeline' => 'nullable|string|max:255',
            'services' => 'nullable|string|max:255',
            'message'  => 'required|string',
        ]);

        try {
            // Save to database for admin dashboard using FastInquiry model
            \App\Models\FastInquiry::create([
                'name'               => $validated['name'],
                'email'              => $validated['email'],
                'company'            => $validated['company'] ?? null,
                'budget'             => $validated['budget'] ?? null,
                'timeline'           => $validated['timeline'] ?? null,
                'services_requested' => $validated['services'] ?? null,
                'project_details'    => $validated['message'],
                'status'             => 'New',
            ]);

            // Set subject for email
            $validated['subject'] = 'New Project Inquiry (Fast Track)';

            // Send email
            Mail::to(config('mail.to.address'))->send(new ContactFormMail($validated));

            // Return with success message
            return back()->with('success', 'Thank you for your inquiry. We will get back to you soon!');
        } catch (\Exception $e) {
            \Log::error('Fast Inquiry form error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            \Log::error($e->getTraceAsString());

            return back()->with('error', 'Sorry, there was an error sending your inquiry. Please try again later.')
                        ->withInput();
        }
    }
}

