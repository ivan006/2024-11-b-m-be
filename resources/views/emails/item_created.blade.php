<!DOCTYPE html>
<html>
<head>
    <title>Item Created</title>
</head>
<body>
<h1>Item Created Successfully</h1>
<p>Dear {{ $itemDetails['recipient_name'] }},</p>
{{ $itemDetails['email_body'] }}
</body>
</html>
