<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div style="background-color: #FC2D2DFF; color: #ffffff; padding: 10px 0; text-align: center;">
            <h1 style="margin: 0;">Reminder</h1>
        </div>
        <div style="padding: 20px;">
            <h1 style="color: #333333;">{{ $reminder->title }}</h1>
            <p style="color: #666666; line-height: 1.6;">{{ $reminder->description }}</p>
        </div>
        <div style="text-align: center; padding: 10px 0; color: #999999; font-size: 12px;">
            <p style="margin: 0;">&copy; {{ date('Y') }} My Reminders. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
