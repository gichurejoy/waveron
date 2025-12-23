<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Feature;
use App\Models\Service;
use App\Models\QuoteItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function features(Request $request)
    {
        $type = $request->input('service_type');
        if (!$type) {
            return response()->json(['error' => 'No service_type'], 400);
        }
        $features = Feature::where('service_type', $type)->where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'name', 'description', 'group', 'is_default']);
        return response()->json($features);
    }

    public function getService(Service $service)
    {
        return response()->json($service);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'service_type' => 'required|string',
            'complexity' => 'required|string',
            'timeline' => 'required|string',
            'feature_count' => 'required|integer',
            'base_price' => 'required|numeric',
            'complexity_multiplier' => 'required|numeric',
            'timeline_multiplier' => 'required|numeric',
            'feature_adjustment' => 'required|numeric',
            'addons_total' => 'nullable|numeric',
            'subtotal' => 'nullable|numeric',
            'tax_rate' => 'nullable|numeric',
            'tax_amount' => 'nullable|numeric',
            'discount_amount' => 'nullable|numeric',
            'discount_code' => 'nullable|string',
            'total' => 'required|numeric',
            'currency' => 'required|string',
            'validity_days' => 'nullable|integer',
            'expires_at' => 'nullable|date',
            'contact_name' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'notes' => 'nullable|string',
            'selected_features' => 'nullable|array',
            'selected_addons' => 'nullable|array',
        ]);

        $quote = Quote::create($data);
        // Save selected features as QuoteItems
        if ($request->has('selected_features')) {
            foreach ($request->selected_features as $feature) {
                QuoteItem::create([
                    'quote_id' => $quote->id,
                    'type' => 'feature',
                    'name' => $feature['name'] ?? $feature,
                    'description' => $feature['description'] ?? '',
                    'price' => 0, // Let frontend/backend pass price in next iterations
                    'quantity' => 1,
                    'total' => 0,
                ]);
            }
        }
        if ($request->has('selected_addons')) {
            foreach ($request->selected_addons as $addon) {
                QuoteItem::create([
                    'quote_id' => $quote->id,
                    'type' => 'addon',
                    'name' => $addon['name'] ?? $addon,
                    'description' => $addon['description'] ?? '',
                    'price' => $addon['price'] ?? 0,
                    'quantity' => 1,
                    'total' => $addon['price'] ?? 0,
                ]);
            }
        }

        // Send email notification
        $admin = config('mail.from.address');
        $to = [$admin];
        if ($quote->contact_email) {
            $to[] = $quote->contact_email;
        }
        Mail::to($to)->send(new \App\Mail\QuoteSubmittedMail($quote->fresh(['items','service'])));

        return response()->json(['success' => true, 'quote' => $quote->fresh(['items', 'service'])]);
    }
}
