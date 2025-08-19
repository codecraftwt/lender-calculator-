<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Password Reset Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f3f3f3;
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
        }

        .container {
            margin-top: 50px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .reset-btn {
            display: block;
            margin: 20px auto;
            padding: 12px 25px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .reset-btn:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 30px;
        }

        .footer a {
            text-decoration: none;
            color: #007bff;
        }

        /* Responsive Styles */
        @media (max-width: 576px) {
            .container {
                padding: 20px;
                margin-top: 20px;
            }

            .reset-btn {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Hello!</h2>
        </div>
        <p>
            You are receiving this email because we received a password change
            request for your account.
        </p>
        <p style="font-weight: 600">Here is your requested OTP</p>
        <h2 style="color: rgb(86 66 161); font-weight: 600">{{ $otp }}</h2> <!-- Display OTP here -->
        <p>This OTP will be valid for 60 seconds.</p>
        <p>
            If you did not request a password change, no further action is required.
        </p>
        <div class="footer">
            <p>Regards,</p>
            <p>Laravel</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>