<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote {{ $quote->quote_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            padding: 30px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #006400;
        }
        .brand {
            color: #006400;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 0.02em;
        }
        .quote-info {
            text-align: right;
        }
        .quote-number {
            font-size: 18px;
            font-weight: bold;
            color: #006400;
            margin-bottom: 5px;
        }
        .quote-date {
            color: #666;
            font-size: 11px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #006400;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            font-weight: bold;
            padding: 8px 15px 8px 0;
            width: 150px;
            color: #555;
        }
        .info-value {
            display: table-cell;
            padding: 8px 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            background-color: #006400;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }
        .items-table tr:last-child td {
            border-bottom: none;
        }
        .text-right {
            text-align: right;
        }
        .total-section {
            margin-top: 20px;
            margin-left: auto;
            width: 300px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .total-row.final {
            border-top: 2px solid #006400;
            border-bottom: 2px solid #006400;
            padding: 15px 0;
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #006400;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 10px;
            color: #666;
            text-align: center;
        }
        .notes {
            background-color: #f9fafb;
            padding: 15px;
            border-left: 4px solid #006400;
            margin-top: 20px;
        }
        .badge {
            display: inline-block;
            padding: 5px 12px;
            background-color: rgba(0, 100, 0, 0.1);
            color: #004d00;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">Waveron Technologies</div>
        <div class="quote-info">
            <div class="quote-number">Quote #{{ $quote->quote_number }}</div>
            <div class="quote-date">Date: {{ $quote->created_at->format('F d, Y') }}</div>
            @if($quote->expires_at)
            <div class="quote-date">Valid until: {{ $quote->expires_at->format('F d, Y') }}</div>
            @endif
            <div style="margin-top: 8px;">
                <span class="badge">{{ strtoupper($quote->status) }}</span>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Contact Information</div>
        <div class="info-grid">
            @if($quote->contact_name)
            <div class="info-row">
                <div class="info-label">Name:</div>
                <div class="info-value">{{ $quote->contact_name }}</div>
            </div>
            @endif
            @if($quote->contact_email)
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $quote->contact_email }}</div>
            </div>
            @endif
            @if($quote->contact_phone)
            <div class="info-row">
                <div class="info-label">Phone:</div>
                <div class="info-value">{{ $quote->contact_phone }}</div>
            </div>
            @endif
            @if($quote->lead)
            <div class="info-row">
                <div class="info-label">Company:</div>
                <div class="info-value">{{ $quote->lead->company ?? 'N/A' }}</div>
            </div>
            @endif
        </div>
    </div>

    <div class="section">
        <div class="section-title">Service Details</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Service:</div>
                <div class="info-value">{{ $quote->service->title ?? $quote->service_type }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Complexity:</div>
                <div class="info-value">{{ ucfirst($quote->complexity) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Timeline:</div>
                <div class="info-value">{{ ucfirst($quote->timeline) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Features:</div>
                <div class="info-value">{{ $quote->feature_count }}</div>
            </div>
        </div>
    </div>

    @if($quote->items->count() > 0)
    <div class="section">
        <div class="section-title">Quote Items</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quote->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td class="text-right">${{ number_format($item->price, 2) }}</td>
                    <td class="text-right">${{ number_format($item->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="total-section">
        @if($quote->subtotal)
        <div class="total-row">
            <span>Subtotal:</span>
            <span>${{ number_format($quote->subtotal, 2) }}</span>
        </div>
        @endif
        @if($quote->discount_amount > 0)
        <div class="total-row">
            <span>Discount @if($quote->discount_code)({{ $quote->discount_code }})@endif:</span>
            <span>-${{ number_format($quote->discount_amount, 2) }}</span>
        </div>
        @endif
        @if($quote->tax_amount > 0)
        <div class="total-row">
            <span>Tax ({{ $quote->tax_rate }}%):</span>
            <span>${{ number_format($quote->tax_amount, 2) }}</span>
        </div>
        @endif
        <div class="total-row final">
            <span>Total:</span>
            <span>${{ number_format($quote->total, 2) }} {{ $quote->currency }}</span>
        </div>
    </div>

    @if($quote->notes)
    <div class="notes">
        <strong>Notes:</strong><br>
        {!! nl2br(e($quote->notes)) !!}
    </div>
    @endif

    <div class="footer">
        <p>This quote is valid until {{ $quote->expires_at ? $quote->expires_at->format('F d, Y') : 'further notice' }}.</p>
        <p>For questions about this quote, please contact us at {{ config('mail.from.address', 'info@waveron.com') }}</p>
        <p style="margin-top: 10px;">&copy; {{ date('Y') }} Waveron Technologies. All rights reserved.</p>
    </div>
</body>
</html>

