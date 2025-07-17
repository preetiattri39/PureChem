<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h2>New Contact Form Submission</h2>
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    @if(!empty($phone))
        <p><strong>Phone:</strong> {{ $phone }}</p>
    @endif
    <p><strong>Message:</strong></p>
    <p>{{ $bodyMessage }}</p>
</body>
</html>
