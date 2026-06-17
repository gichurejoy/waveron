<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        try {
            // Find or create subscriber
            NewsletterSubscriber::updateOrCreate(
                ['email' => $request->email],
                ['is_active' => true]
            );

            return back()->with('newsletter_success', 'Thank you for subscribing to our newsletter!');
        } catch (\Exception $e) {
            \Log::error('Newsletter subscription error: ' . $e->getMessage());
            return back()->with('newsletter_error', 'Sorry, there was an error subscribing. Please try again later.');
        }
    }
}
