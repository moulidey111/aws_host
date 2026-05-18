<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email - POS System</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: Arial, sans-serif; color: #0f172a;">
    <div style="max-width: 650px; margin: 30px auto; background: #ffffff; border-radius: 14px; overflow: hidden; border: 1px solid #e2e8f0;">
        <div style="background: linear-gradient(135deg, #0f172a, #1e293b); padding: 28px 24px; text-align: center;">
            <h1 style="margin: 0; font-size: 24px; color: #ffffff;">POS System</h1>
            <p style="margin: 8px 0 0; color: #cbd5e1; font-size: 14px;">Email Verification Required</p>
        </div>

        <div style="padding: 32px 26px;">
            <p style="font-size: 15px; line-height: 1.8; margin-bottom: 18px;">
                Hello <strong>{{ $user->name }}</strong>,
            </p>

            <p style="font-size: 15px; line-height: 1.8; margin-bottom: 18px;">
                Thank you for registering in the <strong>POS System</strong>.  
                To complete your account setup, please verify your email address using the OTP below:
            </p>

            <div style="text-align: center; margin: 28px 0;">
                <div style="display: inline-block; padding: 18px 28px; background: #0f172a; color: #38bdf8; border-radius: 12px; font-size: 30px; font-weight: bold; letter-spacing: 8px;">
                    {{ $user->email_otp }}
                </div>
            </div>

            <p style="font-size: 14px; line-height: 1.8; margin-bottom: 14px; color: #334155;">
                This OTP is valid for <strong>10 minutes</strong>.
            </p>

            <p style="font-size: 14px; line-height: 1.8; margin-bottom: 14px; color: #334155;">
                If you did not request this registration, you can safely ignore this email.
            </p>

            <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 24px 0;">

            <p style="font-size: 13px; line-height: 1.7; color: #64748b; margin: 0;">
                POS System Team<br>
                Secure Registration & Verification
            </p>
        </div>
    </div>
</body>
</html>