<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP | POS System</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-page">
        <div class="auth-bg-glow auth-bg-glow-1"></div>
        <div class="auth-bg-glow auth-bg-glow-2"></div>

        <div class="auth-container">
            <div class="auth-brand-panel">
                <div class="auth-brand-badge">STEP 2 OF REGISTRATION</div>
                <h1>Verify Your Email with OTP</h1>
                <p>
                    We’ve sent a 6-digit OTP to your email address.
                    Enter the OTP below to verify your account and complete your registration.
                </p>

                <div class="auth-feature-list">
                    <div class="auth-feature-item">
                        <span class="auth-feature-dot"></span>
                        <span>Secure email verification</span>
                    </div>
                    <div class="auth-feature-item">
                        <span class="auth-feature-dot"></span>
                        <span>OTP valid for 10 minutes</span>
                    </div>
                    <div class="auth-feature-item">
                        <span class="auth-feature-dot"></span>
                        <span>Welcome email after successful verification</span>
                    </div>
                </div>
            </div>

            <div class="auth-form-panel">
                <div class="auth-card">
                    <div class="auth-card-header">
                        <h2>OTP Verification</h2>
                        <p>Complete your account verification to continue.</p>
                    </div>

                    @if(session('success'))
                        <div class="alert-box success-alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert-box error-alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert-box error-alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="otp-email-box">
                        <label>Email Address</label>
                        <div class="otp-email-value">{{ $email }}</div>
                    </div>

                    {{-- VERIFY OTP FORM --}}
                    <form action="{{ route('verify.otp.submit') }}" method="POST" class="auth-form">
                        @csrf

                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="form-group">
                            <label for="otp">Enter 6-Digit OTP</label>
                            <input
                                type="text"
                                name="otp"
                                id="otp"
                                placeholder="Enter OTP"
                                maxlength="6"
                                inputmode="numeric"
                                value="{{ old('otp') }}"
                                required
                            >
                        </div>

                        <button type="submit" class="auth-submit-btn">
                            Verify OTP
                        </button>
                    </form>

                    <div class="otp-divider"></div>

                    {{-- RESEND OTP FORM --}}
                    <form action="{{ route('verify.otp.resend') }}" method="POST" class="auth-form">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <button type="submit" class="auth-secondary-btn">
                            Resend OTP
                        </button>
                    </form>

                    <div class="auth-footer-links">
                        <p>
                            Already verified?
                            <a href="{{ route('login.form') }}">Go to Login</a>
                        </p>

                        <p>
                            Want to register again?
                            <a href="{{ route('register.form') }}">Back to Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>