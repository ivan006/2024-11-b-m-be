<!DOCTYPE html>
<html>
<head>
    <title>Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .email-body {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .email-footer {
            font-size: 14px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-body">
        <p>Dear {{ $itemDetails['recipient_name'] }},</p>
        {!! $itemDetails['email_body'] !!}
    </div>
    <div class="email-footer">
        Best regards,<br>
        Your Company Name
    </div>
</div>
</body>
</html>
