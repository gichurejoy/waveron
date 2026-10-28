<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quote Estimate</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #0f172a; color: #f8fafc; margin: 0; padding: 40px 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #1e293b; border-radius: 12px; border: 1px solid #334155; padding: 32px; }
        .header { text-align: center; border-bottom: 1px solid #334155; padding-bottom: 24px; margin-bottom: 24px; }
        .logo { font-size: 24px; font-weight: bold; color: #10b981; }
        .details-box { background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .detail-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px dashed #334155; font-size: 14px; }
        .amount { font-size: 22px; color: #10b981; font-weight: bold; }
        .footer { text-align: center; margin-top: 32px; font-size: 12px; color: #64748b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">WAVERON TECHNOLOGIES</div>
            <div style="color: #94a3b8; font-size: 13px;">Official Quote Run #{{ $quote->id }}</div>
        </div>

        <p>Hello {{ $quote->company ?: 'Client' }},</p>
        <p>Thank you for inquiring with Waveron Technologies. Here is your official software specification estimate:</p>

        <div class="details-box">
            <div class="detail-row">
                <span style="color: #94a3b8;">Service Category</span>
                <span style="font-weight:600; color: #f8fafc;">{{ $quote->service_type }}</span>
            </div>
            <div class="detail-row">
                <span style="color: #94a3b8;">Complexity Scope</span>
                <span style="font-weight:600; color: #f8fafc;">{{ $quote->complexity }}</span>
            </div>
            <div class="detail-row">
                <span style="color: #94a3b8;">Target Timeline</span>
                <span style="font-weight:600; color: #f8fafc;">{{ $quote->timeline }}</span>
            </div>
            <div class="detail-row">
                <span style="color: #94a3b8;">Ballpark Estimate</span>
                <span class="amount">KES {{ number_format($quote->estimated_total) }}</span>
            </div>
        </div>

        <p style="font-size: 14px; color: #cbd5e1;">Our system architects are standing by to review your custom requirements and convert this specification into an active billing ledger statement.</p>

        <div class="footer">
            &copy; {{ date('Y') }} Waveron Technologies Ltd. All rights reserved.
        </div>
    </div>
</body>
</html>
