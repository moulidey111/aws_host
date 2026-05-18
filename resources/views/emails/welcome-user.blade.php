<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the POS System Team</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: Arial, sans-serif; color: #0f172a;">
    <div style="max-width: 650px; margin: 30px auto; background: #ffffff; border-radius: 14px; overflow: hidden; border: 1px solid #e2e8f0;">
        <div style="background: linear-gradient(135deg, #0f172a, #1e293b); padding: 28px 24px; text-align: center;">
            <h1 style="margin: 0; font-size: 24px; color: #ffffff;">Welcome to POS System</h1>
            <p style="margin: 8px 0 0; color: #cbd5e1; font-size: 14px;">Your account is now verified</p>
        </div>

        <div style="padding: 32px 26px;">
            <p style="font-size: 15px; line-height: 1.8; margin-bottom: 18px;">
                Hello <strong>{{ $user->name }}</strong>,
            </p>

            <p style="font-size: 15px; line-height: 1.8; margin-bottom: 18px;">
                Welcome to the <strong>POS System Team</strong> 🎉
            </p>

            <p style="font-size: 15px; line-height: 1.8; margin-bottom: 18px;">
                Your email has been successfully verified, and your account is now active.
                We hope you work smoothly with our team and use the POS system efficiently for
                product management, customer handling, billing, and order operations.
            </p>

            <p style="font-size: 15px; line-height: 1.8; margin-bottom: 18px;">
                We are excited to have you onboard. Wishing you a productive and successful journey with us.
            </p>

            <div style="margin: 28px 0; padding: 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                <p style="margin: 0; font-size: 14px; color: #334155; line-height: 1.8;">
                    <strong>Account Details:</strong><br>
                    Name: {{ $user->name }}<br>
                    Email: {{ $user->email }}<br>
                    Role: {{ ucfirst($user->role) }}
                </p>
            </div>

            <p style="font-size: 14px; line-height: 1.8; margin-bottom: 14px; color: #334155;">
                You can now login and start using the system.
            </p>

            <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 24px 0;">

            <p style="font-size: 13px; line-height: 1.7; color: #64748b; margin: 0;">
                POS System Team<br>
                Smart Retail Billing & Management
            </p>
        </div>
    </div>
</body>
</html>