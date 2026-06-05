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
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold; width: 150px;">Name:</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $data['name'] }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">Contact / Email:</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $data['contact'] }}</td>
        </tr>
    </table>
    
    <h3>Why are you a great fit for Waveron?</h3>
    <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #006400;">
        <p>{!! nl2br(e($data['why_fit'])) !!}</p>
    </div>
    
    <p style="margin-top: 20px;"><em>The applicant's resume is attached to this email.</em></p>
</body>
</html>
