<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\JobApplicationMail;
use App\Models\CareerRole;
use App\Models\JobApplication;

class CareerController extends Controller
{
    public function index()
    {
        $roles = CareerRole::where('status', 'Active')->orderBy('created_at', 'desc')->get();
        return view('careers', compact('roles'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'contact'       => 'required|string|max:255',
            'years_exp'     => 'required|integer|min:0|max:50',
            'why_fit'       => 'required|string',
            'largest_deal'  => 'required|string',
            'proud_sale'    => 'required|string',
            'first_clients' => 'required|string',
            'resume'        => 'required|file|mimes:pdf,doc,docx|max:10240',
            'career_role_id' => 'nullable|exists:career_roles,id',
        ]);

        // Store the resume file
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        $data = [
            'name'          => $request->name,
            'contact'       => $request->contact,
            'years_exp'     => $request->years_exp,
            'why_fit'       => $request->why_fit,
            'largest_deal'  => $request->largest_deal,
            'proud_sale'    => $request->proud_sale,
            'first_clients' => $request->first_clients,
        ];

        // Save to the database
        JobApplication::create([
            'career_role_id' => $request->career_role_id ?: null,
            'name'           => $data['name'],
            'contact'        => $data['contact'],
            'resume_path'    => $resumePath,
            'years_exp'      => $data['years_exp'],
            'why_fit'        => $data['why_fit'],
            'largest_deal'   => $data['largest_deal'],
            'proud_sale'     => $data['proud_sale'],
            'first_clients'  => $data['first_clients'],
            'internal_notes' => [],
            'status'         => 'New',
        ]);

        // Send the notification email
        Mail::to(config('mail.to.address'))->send(new JobApplicationMail($data, $request->file('resume')));

        return redirect()->back()->with('success', 'Application submitted successfully! Our team will review your resume and reach out.');
    }
}
