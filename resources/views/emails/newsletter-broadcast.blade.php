<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $subjectText }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 40px 20px;
            color: #1f2937;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #059669;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .header p {
            color: #d1fae5;
            margin: 6px 0 0 0;
            font-size: 13px;
        }
        .content {
            padding: 32px 30px;
            line-height: 1.6;
            font-size: 15px;
        }
        .content p {
            margin-top: 0;
            margin-bottom: 16px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Waveron Technologies</h1>
            <p>Official Newsletter Broadcast</p>
        </div>
        <div class="content">
            {!! nl2br(e($messageBody)) !!}
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Waveron Technologies. All rights reserved.</p>
            <p>You received this email because you subscribed to our newsletter.</p>
        </div>
    </div>
</body>
</html>
