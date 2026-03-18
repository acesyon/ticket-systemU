@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    :root {
        --white: #ffffff;
        --off-white: #fafafa;
        --light-gray: #f5f5f5;
        --border: #eaeaea;
        --text-primary: #1a1a1a;
        --text-secondary: #666666;
        --text-tertiary: #999999;
        --accent: #2563eb;
        --accent-light: #3b82f6;
        --accent-soft: #dbeafe;
        --success: #10b981;
        --error: #ef4444;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.02), 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.02), 0 4px 6px -2px rgba(0,0,0,0.01);
        --radius-sm: 6px;
        --radius-md: 8px;
        --radius-lg: 12px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, var(--white) 0%, var(--off-white) 100%);
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        line-height: 1.5;
        -webkit-font-smoothing: antialiased;
        min-height: 100vh;
    }

    .container-custom {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 32px;
    }

    /* Typography */
    h1, h2, h3, h4, h5, h6 {
        font-weight: 600;
        letter-spacing: -0.02em;
        color: var(--text-primary);
    }

    .text-gradient {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Page Layout */
    .login-page {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    /* Left Panel */
    .login-left {
        background: linear-gradient(135deg, var(--text-primary) 0%, #2d2d2d 100%);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 64px;
        position: relative;
        overflow: hidden;
    }

    .login-left-bg {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 50%, rgba(37, 99, 235, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(37, 99, 235, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .login-left-content {
        position: relative;
        z-index: 2;
        max-width: 480px;
    }

    .login-brand {
        margin-bottom: 48px;
    }

    .login-brand-icon {
        width: 48px;
        height: 48px;
        background: var(--accent);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 32px;
    }

    .login-brand-icon i {
        color: white;
        font-size: 24px;
    }

    .login-brand h1 {
        font-size: 42px;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 20px;
        color: white;
    }

    .login-brand h1 span {
        color: var(--accent);
    }

    .login-brand p {
        font-size: 18px;
        opacity: 0.8;
        line-height: 1.6;
        margin-bottom: 40px;
    }

    /* Feature List */
    .feature-list {
        list-style: none;
        margin-bottom: 48px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }

    .feature-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 18px;
    }

    .feature-text {
        font-size: 16px;
        opacity: 0.9;
    }

    /* Stats */
    .login-stats {
        display: flex;
        gap: 48px;
    }

    .stat-item {
        display: flex;
        flex-direction: column;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: white;
        line-height: 1.2;
    }

    .stat-label {
        font-size: 14px;
        opacity: 0.6;
        margin-top: 4px;
    }

    /* Right Panel */
    .login-right {
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 64px;
    }

    .login-form-container {
        width: 100%;
        max-width: 400px;
    }

    /* Form Header */
    .form-header {
        margin-bottom: 40px;
        text-align: center;
    }

    .form-header h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--text-primary);
    }

    .form-header p {
        color: var(--text-secondary);
        font-size: 16px;
    }

    /* Social Buttons */
    .social-login {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 32px;
    }

    .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .social-btn:hover {
        background: var(--off-white);
        border-color: var(--accent);
        color: var(--accent);
    }

    .social-btn i {
        font-size: 16px;
    }

    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 32px;
    }

    .divider-line {
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    .divider-text {
        color: var(--text-tertiary);
        font-size: 14px;
        font-weight: 500;
    }

    /* Form Fields */
    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        font-size: 16px;
        transition: color 0.2s;
        pointer-events: none;
        z-index: 2;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px 14px 48px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        color: var(--text-primary);
        font-size: 15px;
        outline: none;
        transition: all 0.2s;
    }

    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-soft);
    }

    .form-control:focus + .input-icon {
        color: var(--accent);
    }

    .form-control::placeholder {
        color: var(--text-tertiary);
    }

    .form-control.is-invalid {
        border-color: var(--error);
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    /* Password Toggle */
    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        cursor: pointer;
        font-size: 16px;
        transition: color 0.2s;
        z-index: 2;
    }

    .password-toggle:hover {
        color: var(--accent);
    }

    /* Error Message */
    .error-message {
        color: var(--error);
        font-size: 13px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .error-message i {
        font-size: 14px;
    }

    /* Form Options */
    .form-options {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
    }

    .remember-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .remember-checkbox input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--accent);
        cursor: pointer;
    }

    .remember-checkbox span {
        color: var(--text-secondary);
        font-size: 14px;
        font-weight: 500;
    }

    .forgot-link {
        color: var(--accent);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: color 0.2s;
    }

    .forgot-link:hover {
        color: var(--accent-light);
        text-decoration: underline;
    }

    /* Submit Button */
    .btn-login {
        width: 100%;
        padding: 16px 24px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: var(--radius-md);
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }

    .btn-login:hover:not(:disabled) {
        background: var(--accent-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-login:active:not(:disabled) {
        transform: translateY(0);
    }

    .btn-login:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .btn-login.loading {
        color: transparent;
    }

    .btn-login.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin: -10px 0 0 -10px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Register Link */
    .register-link {
        margin-top: 28px;
        padding-top: 28px;
        border-top: 1px solid var(--border);
        text-align: center;
    }

    .register-link p {
        color: var(--text-secondary);
        font-size: 15px;
    }

    .register-link a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
        margin-left: 6px;
        transition: color 0.2s;
    }

    .register-link a:hover {
        color: var(--accent-light);
        text-decoration: underline;
    }

    /* Terms Note */
    .terms-note {
        margin-top: 20px;
        text-align: center;
        color: var(--text-tertiary);
        font-size: 13px;
    }

    .terms-note a {
        color: var(--text-secondary);
        text-decoration: underline;
        transition: color 0.2s;
    }

    .terms-note a:hover {
        color: var(--accent);
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate {
        animation: fadeIn 0.5s ease forwards;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .login-page {
            grid-template-columns: 1fr;
        }

        .login-left {
            display: none;
        }

        .login-right {
            padding: 48px 24px;
        }
    }

    @media (max-width: 480px) {
        .login-form-container {
            max-width: 100%;
        }

        .social-login {
            grid-template-columns: 1fr;
        }

        .form-options {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="login-page">
    {{-- Left Panel --}}
    <div class="login-left">
        <div class="login-left-bg"></div>
        
        <div class="login-left-content animate">
            <div class="login-brand">
                <div class="login-brand-icon">
                    <i class="bi bi-ticket-perforated"></i>
                </div>
                <h1>Your next <span>great experience</span> awaits</h1>
                <p>Discover and book the best events in your city — from intimate concerts to major festivals.</p>
            </div>

            <ul class="feature-list">
                <li class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <span class="feature-text">500+ events monthly across 100+ cities</span>
                </li>
                <li class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <span class="feature-text">Secure booking with instant confirmation</span>
                </li>
                <li class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <span class="feature-text">24/7 customer support</span>
                </li>
            </ul>

            <div class="login-stats">
                <div class="stat-item">
                    <span class="stat-number">50K+</span>
                    <span class="stat-label">Happy customers</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Events</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">100+</span>
                    <span class="stat-label">Cities</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Panel --}}
    <div class="login-right">
        <div class="login-form-container animate" style="animation-delay: 0.1s">
            <div class="form-header">
                <h2>Welcome back</h2>
                <p>Sign in to continue to your account</p>
            </div>

            {{-- Social Login --}}
            <div class="social-login">
                <a href="#" class="social-btn">
                    <i class="bi bi-google"></i>
                    Google
                </a>
                <a href="#" class="social-btn">
                    <i class="bi bi-facebook"></i>
                    Facebook
                </a>
                <a href="#" class="social-btn">
                    <i class="bi bi-twitter-x"></i>
                    Twitter
                </a>
            </div>

            <div class="divider">
                <span class="divider-line"></span>
                <span class="divider-text">or continue with email</span>
                <span class="divider-line"></span>
            </div>

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Email address</label>
                    <div class="input-wrapper">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="you@example.com"
                               required
                               autofocus>
                    </div>
                    @error('email')
                        <span class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="Enter your password"
                               required>
                        <i class="bi bi-eye password-toggle" id="togglePassword"></i>
                    </div>
                    @error('password')
                        <span class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Options --}}
                <div class="form-options">
                    <label class="remember-checkbox">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot password?
                    </a>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn-login" id="submitBtn">
                    Sign In
                </button>
            </form>

            {{-- Register Link --}}
            <div class="register-link">
                <p>
                    Don't have an account?
                    <a href="{{ route('register') }}">Create one</a>
                </p>
            </div>

            <p class="terms-note">
                By signing in, you agree to our
                <a href="#">Terms of Service</a> and
                <a href="#">Privacy Policy</a>
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Password visibility toggle
    document.getElementById('togglePassword')?.addEventListener('click', function() {
        const password = document.getElementById('password');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle icon
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    // Form loading state
    document.getElementById('loginForm')?.addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    });

    // Auto-hide error messages after 5 seconds
    document.querySelectorAll('.error-message').forEach(error => {
        setTimeout(() => {
            error.style.opacity = '0';
            error.style.transition = 'opacity 0.3s';
        }, 5000);
    });

    // Smooth scroll to top on errors
    @if($errors->any())
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    @endif

    // Input focus effects
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            const icon = this.parentElement.querySelector('.input-icon');
            if (icon) icon.style.color = 'var(--accent)';
        });

        input.addEventListener('blur', function() {
            const icon = this.parentElement.querySelector('.input-icon');
            if (icon) icon.style.color = '';
        });
    });
</script>
@endpush