<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Referral Logged - Waveron Technologies</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #0f172a; color: #f8fafc; margin: 0; padding: 40px 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #1e293b; border-radius: 12px; border: 1px solid #334155; padding: 32px; }
        .header { text-align: center; border-bottom: 1px solid #334155; padding-bottom: 24px; margin-bottom: 24px; }
        .logo { font-size: 24px; font-weight: bold; color: #0891b2; letter-spacing: -0.5px; }
        .sublogo { color: #94a3b8; font-size: 13px; margin-top: 4px; }
        .code-box { background: #0f172a; border: 2px dashed #0891b2; border-radius: 10px; padding: 20px; text-align: center; margin: 24px 0; }
        .code { font-family: monospace; font-size: 28px; font-weight: bold; color: #38bdf8; letter-spacing: 2px; }
        .details-box { background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .detail-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px dashed #334155; font-size: 14px; }
        .detail-row:last-child { border-bottom: none; }
        .label { color: #94a3b8; }
        .value { font-weight: 600; color: #f8fafc; }
        .steps { background: rgba(8, 145, 178, 0.1); border-left: 4px solid #0891b2; padding: 16px; border-radius: 0 8px 8px 0; margin: 20px 0; }
        .footer { text-align: center; margin-top: 32px; font-size: 12px; color: #64748b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">WAVERON TECHNOLOGIES</div>
            <div class="sublogo">Client Referral &amp; Partnerships Program</div>
        </div>

        <p>Hello <strong>{{ $referral->referrer_name }}</strong>,</p>
        <p>Thank you for introducing <strong>{{ $referral->client_name }}</strong> to Waveron Technologies! Your referral has been logged into our enterprise sales pipeline.</p>

        <div class="code-box">
            <div style="font-size: 12px; text-transform: uppercase; color: #94a3b8; letter-spacing: 1px; margin-bottom: 6px;">Your Dedicated Tracking Code</div>
            <div class="code">{{ $referral->referral_code }}</div>
            <div style="font-size: 11px; color: #94a3b8; margin-top: 6px;">Quote this code whenever you follow up with our partnerships team.</div>
        </div>

        <div class="details-box">
            <div class="detail-row">
                <span class="label">Referred Client</span>
                <span class="value">{{ $referral->client_name }}</span>
            </div>
            @if($referral->client_contact_person)
            <div class="detail-row">
                <span class="label">Contact Person</span>
                <span class="value">{{ $referral->client_contact_person }}</span>
            </div>
            @endif
            <div class="detail-row">
                <span class="label">Services Pitched</span>
                <span class="value">{{ Str::limit($referral->services_needed, 60) }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Pipeline Status</span>
                <span class="value" style="color: #38bdf8;">{{ $referral->status }}</span>
            </div>
        </div>

        <div class="steps">
            <strong style="color: #38bdf8;">How Commission Payout Works:</strong>
            <ol style="margin: 8px 0 0 16px; padding: 0; font-size: 13px; line-height: 1.6; color: #cbd5e1;">
                <li>Our solutions team connects with {{ $referral->client_name }} to finalize requirements and scope.</li>
                <li>Upon contract signing and payment clearance, your stipulated commission is approved.</li>
                <li>Funds are disbursed directly via M-Pesa or bank transfer to {{ $referral->referrer_contact }}.</li>
            </ol>
        </div>

        <p style="font-size: 13px; color: #94a3b8;">
            Have questions or additional project details? Reply to this email or reach us at <a href="mailto:info@waverontechnologies.co.ke" style="color: #38bdf8;">info@waverontechnologies.co.ke</a>.
        </p>

        <div class="footer">
            &copy; {{ date('Y') }} Waveron Technologies Ltd. Upper Hill, Nairobi, Kenya. All rights reserved.
        </div>
    </div>
</body>
</html>
