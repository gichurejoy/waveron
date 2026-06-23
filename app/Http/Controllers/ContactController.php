<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Mail\EstimateMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'company' => 'nullable|string|max:255',
            'budget' => 'nullable|string|max:255',
            'timeline' => 'nullable|string|max:255',
            'services' => 'nullable|string|max:255',
        ]);

        try {
            // Send email
            Mail::to(config('mail.to.address'))->send(new ContactFormMail($validated));

            // Return with success message
            return back()->with('success', 'Thank you for your message. We will get back to you soon!');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Contact form error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            \Log::error($e->getTraceAsString());
            
            // Return with error message
            return back()->with('error', 'Sorry, there was an error sending your message. Please try again later.')
                        ->withInput();
        }
    }

    public function emailEstimate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'summary' => 'required|array',
            'summary.serviceLabel' => 'required|string',
            'summary.complexityLabel' => 'required|string',
            'summary.timelineLabel' => 'required|string',
            'summary.features' => 'required',
            'summary.selectedFeatures' => 'nullable|array',
            'summary.addonNames' => 'nullable|array',
            'summary.total' => 'required',
            'summary.monthly' => 'required',
            'summary.addonTotal' => 'nullable',
            'summary.featureAdj' => 'nullable',
        ]);

        $email = $validated['email'];
        $summary = $validated['summary'];
        $summary['recipient_email'] = $email;

        try {
            // Send directly to info@waverontechnologies.co.ke
            Mail::to('info@waverontechnologies.co.ke')->send(new EstimateMail($summary));

            // Also send a copy directly to the user
            Mail::to($email)->send(new EstimateMail($summary));

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
}
