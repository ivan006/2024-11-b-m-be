<!DOCTYPE html>
<html>
<head>
    <title>Item Created</title>
</head>
<body>
<h1>Item Created Successfully</h1>
<p>Dear {{ $itemDetails['recipient_name'] }},</p>
<p>Your item "{{ $itemDetails['item_name'] }}" has been created successfully!</p>
<p>Thank you for using our service.</p>
</body>
</html>
