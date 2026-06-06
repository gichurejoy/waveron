<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobApplicationMail;

class CareerController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'why_fit' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB limit
        ]);

        $data = [
            'name' => $request->name,
            'contact' => $request->contact,
            'why_fit' => $request->why_fit,
        ];

        // Send the email with the attached file
        Mail::to(config('mail.to.address'))->send(new JobApplicationMail($data, $request->file('resume')));

        return redirect()->back()->with('success', 'Application submitted successfully! Our team will review your resume and reach out.');
    }
}
