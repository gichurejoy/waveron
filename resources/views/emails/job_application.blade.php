<!DOCTYPE html>
<html>
<head>
    <title>New Job Application</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>New Salesperson Application</h2>
    <p>A new candidate has applied for the Salesperson position.</p>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold; width: 200px;">Name:</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $data['name'] }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">Contact / Email:</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $data['contact'] }}</td>
        </tr>
    </table>

    <h3 style="color:#006400;">Why are you a great fit for Waveron?</h3>
    <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #006400; margin-bottom: 20px;">
        <p>{!! nl2br(e($data['why_fit'])) !!}</p>
    </div>

    <h3 style="color:#006400;">1. What is the largest deal you have personally closed?</h3>
    <p style="font-size:0.85em; color:#666;">Include the product/service sold, approximate deal value, and your specific role in the sale.</p>
    <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #006400; margin-bottom: 20px;">
        <p>{!! nl2br(e($data['largest_deal'])) !!}</p>
    </div>

    <h3 style="color:#006400;">2. Describe a sale you are particularly proud of.</h3>
    <p style="font-size:0.85em; color:#666;">What was the client's challenge, how did you approach the opportunity, and what was the outcome?</p>
    <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #006400; margin-bottom: 20px;">
        <p>{!! nl2br(e($data['proud_sale'])) !!}</p>
    </div>

    <h3 style="color:#006400;">3. How would you find your first three potential clients within 30 days?</h3>
    <p style="font-size:0.85em; color:#666;">Please be as specific as possible.</p>
    <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #006400; margin-bottom: 20px;">
        <p>{!! nl2br(e($data['first_clients'])) !!}</p>
    </div>
    
    <p style="margin-top: 20px;"><em>The applicant's resume is attached to this email.</em></p>
</body>
</html>
