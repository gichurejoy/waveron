<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Client Referral - Waveron Admin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #0f172a; color: #f8fafc; margin: 0; padding: 40px 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #1e293b; border-radius: 12px; border: 1px solid #334155; padding: 32px; }
        .header { text-align: center; border-bottom: 1px solid #334155; padding-bottom: 24px; margin-bottom: 24px; }
        .logo { font-size: 22px; font-weight: bold; color: #10b981; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 9999px; font-size: 11px; font-weight: bold; background: rgba(16, 185, 129, 0.2); color: #34d399; margin-top: 8px; }
        .details-box { background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .detail-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px dashed #334155; font-size: 13px; }
        .detail-row:last-child { border-bottom: none; }
        .label { color: #94a3b8; }
        .value { font-weight: 600; color: #f8fafc; }
        .footer { text-align: center; margin-top: 32px; font-size: 12px; color: #64748b; }
        .btn { display: inline-block; background-color: #0891b2; color: #ffffff; padding: 12px 24px; border-radius: 8px; font-weight: bold; text-decoration: none; margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">NEW CLIENT REFERRAL SUBMITTED</div>
            <div class="badge">Code: {{ $referral->referral_code }}</div>
        </div>

        <p>A new client lead has been referred through the public Careers &amp; Partnerships portal.</p>

        <div class="details-box">
            <div class="detail-row">
                <span class="label">Target Client / Company</span>
                <span class="value">{{ $referral->client_name }}</span>
            </div>
            @if($referral->client_contact_person)
            <div class="detail-row">
                <span class="label">Client Contact Person</span>
                <span class="value">{{ $referral->client_contact_person }}</span>
            </div>
            @endif
            @if($referral->client_email)
            <div class="detail-row">
                <span class="label">Client Email</span>
                <span class="value">{{ $referral->client_email }}</span>
            </div>
            @endif
            @if($referral->client_phone)
            <div class="detail-row">
                <span class="label">Client Phone</span>
                <span class="value">{{ $referral->client_phone }}</span>
            </div>
            @endif
            <div class="detail-row">
                <span class="label">Referred By</span>
                <span class="value">{{ $referral->referrer_name }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Referrer Contact</span>
                <span class="value">{{ $referral->referrer_contact }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Services Pitched</span>
                <span class="value">{{ $referral->services_needed ?: 'General enterprise technology inquiry' }}</span>
            </div>
        </div>

        @if($referral->notes)
        <div style="background: #0f172a; padding: 14px; border-radius: 8px; border: 1px solid #334155; margin-bottom: 20px; font-size: 13px;">
            <strong style="color: #94a3b8; display: block; margin-bottom: 4px;">Additional Context / Notes:</strong>
            <p style="margin: 0; color: #cbd5e1;">{{ $referral->notes }}</p>
        </div>
        @endif

        <div style="text-align: center;">
            <a href="{{ url('/admin/careers-and-referrals') }}" class="btn">View in Careers &amp; Referrals Pipeline</a>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Waveron Technologies Ltd. Automated Admin Dispatch.
        </div>
    </div>
</body>
</html>
