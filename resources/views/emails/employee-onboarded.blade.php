<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Waveron Technologies</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #0f172a; color: #f8fafc; margin: 0; padding: 40px 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #1e293b; border-radius: 16px; border: 1px solid #334155; padding: 36px; }
        .header { text-align: center; border-bottom: 1px solid #334155; padding-bottom: 24px; margin-bottom: 28px; }
        .logo { font-size: 26px; font-weight: 800; color: #10b981; letter-spacing: -0.5px; }
        .role-pill { display: inline-block; padding: 6px 16px; border-radius: 9999px; font-size: 13px; font-weight: 600; background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); margin-top: 8px; }
        .cred-card { background: #0f172a; border-radius: 12px; border: 1px solid #334155; padding: 20px; margin: 24px 0; }
        .cred-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #1e293b; font-size: 14px; }
        .cred-row:last-child { border-bottom: none; }
        .cred-label { color: #94a3b8; }
        .cred-value { font-weight: 600; color: #f8fafc; font-family: monospace; }
        .btn { display: inline-block; background-color: #10b981; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: bold; font-size: 15px; margin-top: 16px; }
        .footer { text-align: center; margin-top: 36px; font-size: 12px; color: #64748b; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">WAVERON TECHNOLOGIES</div>
            <div class="role-pill">{{ $roleTitle }}</div>
        </div>

        <h2 style="margin-top: 0; font-size: 20px; color: #f8fafc;">Welcome aboard, {{ $employee->name }}!</h2>

        <p style="color: #cbd5e1; font-size: 15px; line-height: 1.6;">
            We are thrilled to welcome you to the team at Waveron Technologies. Your employee account has been created, and you now have access to our team portal.
        </p>

        <div class="cred-card">
            <div style="font-size: 12px; text-transform: uppercase; color: #10b981; font-weight: 700; margin-bottom: 12px; letter-spacing: 0.5px;">Your Access Credentials</div>
            <div class="cred-row">
                <span class="cred-label">Portal URL:</span>
                <span class="cred-value">{{ url('/admin') }}</span>
            </div>
            <div class="cred-row">
                <span class="cred-label">Login Email:</span>
                <span class="cred-value">{{ $employee->email }}</span>
            </div>
            <div class="cred-row">
                <span class="cred-label">Temporary Password:</span>
                <span class="cred-value">{{ $temporaryPassword }}</span>
            </div>
            @if($employee->commission_rate > 0)
            <div class="cred-row">
                <span class="cred-label">Commission Rate:</span>
                <span class="cred-value" style="color: #34d399;">{{ number_format($employee->commission_rate, 1) }}%</span>
            </div>
            @endif
        </div>

        <p style="color: #94a3b8; font-size: 13px;">
            Please log in and update your password immediately upon your first sign in.
        </p>

        <div style="text-align: center; margin: 28px 0;">
            <a href="{{ url('/admin/login') }}" class="btn" style="color: #ffffff;">Sign In to Portal &rarr;</a>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Waveron Technologies Ltd. All rights reserved.<br>
            Nairobi, Kenya &bull; technical@waverontechnologies.co.ke
        </div>
    </div>
</body>
</html>
