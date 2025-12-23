@php($quote = $quote)
<p style="font-size:1.1em;margin-bottom:1.2em">
    <strong>Quote #{{ $quote->quote_number }}</strong> - {{ ucfirst($quote->status) }}<br>
    <strong>Service:</strong> {{ $quote->service->title ?? $quote->service_type }}<br>
    <strong>Contact:</strong> {{ $quote->contact_name ?? '-' }} ({{ $quote->contact_email }})<br>
    @if ($quote->contact_phone)
        <strong>Phone:</strong> {{ $quote->contact_phone }}<br>
    @endif
    <strong>Created:</strong> {{ $quote->created_at->format('Y-m-d H:i') }}<br>
</p>

<hr/>
<p>
<strong>Configuration:</strong><br>
- <strong>Complexity:</strong> {{ $quote->complexity }}<br>
- <strong>Timeline:</strong> {{ $quote->timeline }}<br>
- <strong>Feature count:</strong> {{ $quote->feature_count }}<br>
@if (!empty($quote->selected_features))
Features:
<ul>
    @foreach ($quote->selected_features as $f)
        <li>{{ is_array($f) ? $f['name'] : $f }}</li>
    @endforeach
</ul>
@endif
@if (!empty($quote->selected_addons))
Add-ons:
<ul>
    @foreach ($quote->selected_addons as $a)
        <li>{{ is_array($a) ? ($a['name'] ?? $a[0]) : $a }}</li>
    @endforeach
</ul>
@endif
@if($quote->notes)
    <strong>Notes:</strong> {{ $quote->notes }}<br>
@endif
</p>
<hr/>
<p><strong>Subtotal:</strong> ${{ number_format($quote->subtotal ?? 0, 2) }}<br>
<strong>Discount:</strong> ${{ number_format($quote->discount_amount ?? 0, 2) }} @if($quote->discount_code) (Code: {{ $quote->discount_code }}) @endif<br>
<strong>Tax/VAT:</strong> ${{ number_format($quote->tax_amount ?? 0, 2) }} ({{ $quote->tax_rate }}%)<br>
<strong>Total:</strong> <span style="font-size:1.25em;font-weight:bold">${{ number_format($quote->total, 2) }} {{ $quote->currency }}</span></p>
<hr/>
<p>
<a href="{{ url('admin/quotes/'.$quote->id.'/view') }}" style="display:inline-block;padding:0.5em 1.5em;background:#1F2937;color:white;text-decoration:none;border-radius:8px">View Full Quote in Admin</a>
</p>







