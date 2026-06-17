<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Contact List</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0e4e4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background-color: #4f46e5; padding: 32px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; }
        .body { padding: 32px; color: #374151; }
        .body h2 { font-size: 20px; margin-top: 0; }
        .body p { line-height: 1.6; color: #6b7280; }
        .highlight { color: #4f46e5; font-weight: bold; }
        .footer { background-color: #f9fafb; padding: 20px 32px; text-align: center; color: #9ca3af; font-size: 13px; border-top: 1px solid #e5e7eb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Contact List</h1>
        </div>
        <div class="body">
            <h2>Welcome, {{ $user->name }}!</h2>
            <p>
                Thank you for registering on <span class="highlight">Contact List</span>.
                Your account has been successfully created.
            </p>
            <p>
                You can now log in and start managing your contacts.
            </p>
            <p>
                <strong>Account Details:</strong><br>
                Name: {{ $user->name }}<br>
                Email: {{ $user->email }}<br>
                Registered: {{ $user->created_at->format('d M Y, h:i A') }}
            </p>
            <p>If you did not create this account, please ignore this email.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Contact List. All rights reserved.
        </div>
    </div>
</body>
</html>
