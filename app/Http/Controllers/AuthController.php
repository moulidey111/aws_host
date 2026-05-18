<?php

namespace App\Http\Controllers;

use App\Mail\UserOtpVerificationMail;
use App\Mail\UserWelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Show login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Show register page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,sales',
            'password' => 'required|min:6|confirmed',
        ]);

        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'email_otp' => $otp,
            'email_otp_expires_at' => Carbon::now()->addMinutes(10),
            'email_verified_at' => null,
        ]);

        try {
            Mail::to($user->email)->send(new UserOtpVerificationMail($user));
        } catch (\Exception $e) {
            $user->delete();

            return back()->withInput()->with('error', 'Registration failed because OTP email could not be sent. Please check your mail configuration and try again.');
        }

        return redirect()->route('verify.otp.form', ['email' => $user->email])
            ->with('success', 'Registration successful. An OTP has been sent to your email. Please verify your account.');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Invalid email or password.');
        }

        if (is_null($user->email_verified_at)) {
            return redirect()->route('verify.otp.form', ['email' => $user->email])
                ->with('error', 'Please verify your email with OTP before login.');
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // Show dashboard
    public function dashboard()
    {
        return view('dashboard.index');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')->with('success', 'Logged out successfully.');
    }

    // Show OTP verification page
    public function showVerifyOtp(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return redirect()->route('register.form')->with('error', 'Invalid OTP verification request.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('register.form')->with('error', 'User not found for OTP verification.');
        }

        if (!is_null($user->email_verified_at)) {
            return redirect()->route('login.form')->with('success', 'Email already verified. Please login.');
        }

        return view('auth.verify-otp', compact('email'));
    }

    // Handle OTP verification
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('register.form')->with('error', 'User not found.');
        }

        if (!is_null($user->email_verified_at)) {
            return redirect()->route('login.form')->with('success', 'Email already verified. Please login.');
        }

        if (empty($user->email_otp) || empty($user->email_otp_expires_at)) {
            return back()->with('error', 'OTP is missing. Please request a new OTP.');
        }

        if (Carbon::now()->gt($user->email_otp_expires_at)) {
            return back()->with('error', 'OTP has expired. Please request a new OTP.');
        }

        if ($user->email_otp !== $request->otp) {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }

        $user->email_verified_at = Carbon::now();
        $user->email_otp = null;
        $user->email_otp_expires_at = null;
        $user->save();

        try {
            Mail::to($user->email)->send(new UserWelcomeMail($user));
        } catch (\Exception $e) {
            // Welcome email fail won't block login
        }

        return redirect()->route('login.form')
            ->with('success', 'Email verified successfully. Welcome to the POS System! You can now login.');
    }

    // Resend OTP
    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('register.form')->with('error', 'User not found.');
        }

        if (!is_null($user->email_verified_at)) {
            return redirect()->route('login.form')->with('success', 'Email already verified. Please login.');
        }

        $otp = rand(100000, 999999);

        $user->email_otp = $otp;
        $user->email_otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        try {
            Mail::to($user->email)->send(new UserOtpVerificationMail($user));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to resend OTP email. Please try again.');
        }

        return back()->with('success', 'A new OTP has been sent to your email.');
    }
}