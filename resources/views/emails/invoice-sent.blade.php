<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Statement</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #0f172a; color: #f8fafc; margin: 0; padding: 40px 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #1e293b; border-radius: 12px; border: 1px solid #334155; padding: 32px; }
        .header { text-align: center; border-bottom: 1px solid #334155; padding-bottom: 24px; margin-bottom: 24px; }
        .logo { font-size: 24px; font-weight: bold; color: #10b981; letter-spacing: -0.5px; }
        .sublogo { color: #94a3b8; font-size: 13px; margin-top: 4px; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 600; text-transform: uppercase; }
        .badge-sent { background-color: rgba(14, 165, 233, 0.2); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.3); }
        .details-box { background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .detail-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px dashed #334155; font-size: 14px; }
        .detail-row:last-child { border-bottom: none; }
        .label { color: #94a3b8; }
        .value { font-weight: 600; color: #f8fafc; }
        .amount { font-size: 22px; color: #10b981; font-weight: bold; }
        .footer { text-align: center; margin-top: 32px; font-size: 12px; color: #64748b; }
        .btn { display: inline-block; background-color: #10b981; color: #0f172a; padding: 12px 24px; border-radius: 6px; font-weight: bold; text-decoration: none; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">WAVERON TECHNOLOGIES</div>
            <div class="sublogo">Enterprise Systems & Web Architecture</div>
        </div>

        <p>Dear {{ $invoice->client_name }},</p>
        <p>Your official invoice statement <strong>{{ $invoice->invoice_number }}</strong> has been issued and is ready for payment.</p>

        <div class="details-box">
            <div class="detail-row">
                <span class="label">Invoice Number</span>
                <span class="value">{{ $invoice->invoice_number }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Project Scope</span>
                <span class="value">{{ $invoice->project_type }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Issued Date</span>
                <span class="value">{{ $invoice->issued_at ? \Carbon\Carbon::parse($invoice->issued_at)->format('d M Y') : 'N/A' }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Payment Terms</span>
                <span class="value">{{ $invoice->credit_terms }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Amount Payable</span>
                <span class="amount">KES {{ number_format($invoice->amount) }}</span>
            </div>
        </div>

        <p style="font-size: 14px; color: #cbd5e1;">
            Attached to this email is your official PDF statement with complete billing breakdown and Safaricom M-Pesa payment guidelines.
        </p>

        <div class="footer">
            &copy; {{ date('Y') }} Waveron Technologies Ltd. All rights reserved.<br>
            Nairobi, Kenya &bull; info@waverontechnologies.co.ke
        </div>
    </div>
</body>
</html>
