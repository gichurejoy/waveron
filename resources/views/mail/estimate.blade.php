<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimate Summary</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f6f9fc; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333333; -webkit-font-smoothing: antialiased;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f6f9fc; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);">
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #006400; padding: 30px 40px; text-align: left;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 800; letter-spacing: 0.5px;">Waveron Technologies</h1>
                            <p style="color: #a3e635; margin: 5px 0 0 0; font-size: 14px; font-weight: 600;">Project Scope Ballpark Estimate</p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 20px 0; font-size: 16px; line-height: 1.6; color: #4b5563;">
                                Hello,
                            </p>
                            <p style="margin: 0 0 30px 0; font-size: 16px; line-height: 1.6; color: #4b5563;">
                                Thank you for configuring a ballpark estimate for your project with Waveron Technologies. Below is the detailed breakdown of the features and options selected.
                            </p>
                            
                            <!-- Breakdown Table -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 30px; border: 1px solid #e5e7eb; border-radius: 6px; overflow: hidden;">
                                <tr>
                                    <td colspan="2" style="background-color: #f9fafb; padding: 15px 20px; border-bottom: 1px solid #e5e7eb; font-weight: bold; font-size: 15px; color: #111827;">
                                        Configuration Details
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%" style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; font-size: 14px; color: #6b7280; font-weight: 600;">Service Type</td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; font-size: 14px; color: #111827; font-weight: bold;">{{ $summary['serviceLabel'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; font-size: 14px; color: #6b7280; font-weight: 600;">Complexity</td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; font-size: 14px; color: #111827;">{{ $summary['complexityLabel'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; font-size: 14px; color: #6b7280; font-weight: 600;">Timeline Urgency</td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; font-size: 14px; color: #111827;">{{ $summary['timelineLabel'] }}</td>
                                </tr>
                                @if(!empty($summary['selectedFeatures']))
                                <tr>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; font-size: 14px; color: #6b7280; font-weight: 600; vertical-align: top;">Key Features</td>
                                    <td style="padding: 12px 20px; border-bottom: 1px solid #e5e7eb; font-size: 13px; color: #374151; line-height: 1.5;">
                                        <ul style="margin: 0; padding-left: 18px;">
                                            @foreach($summary['selectedFeatures'] as $feature)
                                                <li>{{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                @endif
                                @if(!empty($summary['addonNames']))
                                <tr>
                                    <td style="padding: 12px 20px; font-size: 14px; color: #6b7280; font-weight: 600; vertical-align: top;">Add-ons</td>
                                    <td style="padding: 12px 20px; font-size: 13px; color: #374151; line-height: 1.5;">
                                        <ul style="margin: 0; padding-left: 18px;">
                                            @foreach($summary['addonNames'] as $addon)
                                                <li>{{ $addon }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                @endif
                            </table>

                            <!-- Pricing -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
                                <tr>
                                    <td style="font-size: 16px; color: #166534; font-weight: 600; padding-bottom: 10px;">Estimated Total</td>
                                    <td align="right" style="font-size: 24px; color: #166534; font-weight: bold; padding-bottom: 10px;">Ksh {{ number_format($summary['total'], 0) }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; color: #15803d; border-top: 1px solid #dcfce7; padding-top: 10px;">Est. Monthly Payment (6-mo)</td>
                                    <td align="right" style="font-size: 16px; color: #15803d; font-weight: bold; border-top: 1px solid #dcfce7; padding-top: 10px;">Ksh {{ number_format($summary['monthly'], 0) }}/mo</td>
                                </tr>
                            </table>

                            <div style="border-left: 4px solid #006400; padding-left: 15px; margin-bottom: 30px; font-size: 13px; line-height: 1.5; color: #6b7280; font-style: italic;">
                                Note: This is an indicative ballpark estimate based on configuration variables. Final scope, integrations, and success criteria will be detailed in our official contract proposal.
                            </div>

                            <!-- CTA Button -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align: center; margin-bottom: 30px;">
                                <tr>
                                    <td>
                                        <a href="https://waverontechnologies.co.ke/contact" style="background-color: #006400; color: #ffffff; display: inline-block; padding: 12px 30px; font-size: 16px; font-weight: 600; text-decoration: none; border-radius: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Book a Scoping Call</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; border-top: 1px solid #e5e7eb; padding: 25px 40px; text-align: center; font-size: 12px; color: #9ca3af;">
                            <p style="margin: 0 0 5px 0;">This email was sent to {{ $summary['recipient_email'] }} and info@waverontechnologies.co.ke.</p>
                            <p style="margin: 0;">&copy; {{ date('Y') }} Waveron Technologies. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
