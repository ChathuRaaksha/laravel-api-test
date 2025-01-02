<!DOCTYPE html>
<html>
<head>
    <title>New User Registered</title>
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
            background-color: #007bff;
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
        .email-body ul {
            padding-left: 20px;
        }
        .email-body ul li {
            margin-bottom: 10px;
        }
        .email-footer {
            text-align: center;
            background-color: #f4f4f4;
            padding: 15px;
            color: #666666;
            font-size: 14px;
        }
        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>New User Registered</h1>
        </div>
        <div class="email-body">
            <p>A new user has signed up on your platform. Here are the details:</p>
            <ul>
                <li><strong>Name:</strong> {{ $name }}</li>
                <li><strong>Email:</strong> {{ $email }}</li>
            </ul>
        </div>
        <div class="email-footer">
            <p>Need assistance? <a href="mailto:support@checkproof.com">Contact Support</a></p>
            <p>&copy; {{ date('Y') }} CheckProof Platform. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
