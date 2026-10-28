<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Candidate Application Update</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #0f172a; color: #f8fafc; margin: 0; padding: 40px 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #1e293b; border-radius: 12px; border: 1px solid #334155; padding: 32px; }
        .header { text-align: center; border-bottom: 1px solid #334155; padding-bottom: 24px; margin-bottom: 24px; }
        .logo { font-size: 24px; font-weight: bold; color: #10b981; }
        .badge { display: inline-block; padding: 6px 14px; border-radius: 9999px; font-size: 13px; font-weight: bold; text-transform: uppercase; background-color: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
        .footer { text-align: center; margin-top: 32px; font-size: 12px; color: #64748b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">WAVERON CAREERS</div>
            <div style="color: #94a3b8; font-size: 13px; margin-top: 4px;">Technical Engineering & Business Development</div>
        </div>

        <p>Dear {{ $application->name }},</p>

        <p>Thank you for applying for a technical role at Waveron Technologies.</p>

        <p>We are pleased to inform you that your application status has been updated to:</p>
        
        <div style="text-align: center; margin: 24px 0;">
            <span class="badge">{{ $status }}</span>
        </div>

        @if($status === 'Interview')
            <p style="font-size: 14px; color: #cbd5e1;">Our technical recruitment team will reach out to you directly to schedule a technical evaluation and panel interview session.</p>
        @elseif($status === 'Hired')
            <p style="font-size: 14px; color: #cbd5e1;">Congratulations! An onboarding account has been provisioned for you. Look out for welcome credentials from the admin system.</p>
        @else
            <p style="font-size: 14px; color: #cbd5e1;">Our team is actively reviewing your dossier and will keep you informed of next steps.</p>
        @endif

        <div class="footer">
            &copy; {{ date('Y') }} Waveron Technologies Ltd. All rights reserved.
        </div>
    </div>
</body>
</html>
