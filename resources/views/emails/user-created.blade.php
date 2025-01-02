<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #4caf50;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }
        .email-body h2 {
            color: #4caf50;
        }
        .email-footer {
            text-align: center;
            background-color: #f4f4f4;
            padding: 15px;
            color: #666666;
            font-size: 14px;
        }
        .email-footer a {
            color: #4caf50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Welcome to Our CheckProof Platform</h1>
        </div>
        <div class="email-body">
            <h2>Hello, {{ $name }}!</h2>
            <p>We’re thrilled to have you join us. Your account has been successfully created, and you’re now part of a growing community of amazing people.</p>
            <p>Feel free to explore and let us know if you have any questions or need assistance.</p>
            <p>Thank you for choosing us!</p>
        </div>
        <div class="email-footer">
            <p>Need help? <a href="mailto:support@checkproof.com">Contact Support</a></p>
            <p>&copy; {{ date('Y') }} CheckProof Platform. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
