@extends('layouts.app')

@section('title', 'Register')

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
        --warning: #f59e0b;
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
    .register-page {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1.2fr;
    }

    /* Left Panel */
    .register-left {
        background: linear-gradient(135deg, var(--text-primary) 0%, #2d2d2d 100%);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 64px;
        position: relative;
        overflow: hidden;
    }

    .register-left-bg {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 30%, rgba(37, 99, 235, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(37, 99, 235, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .register-left-content {
        position: relative;
        z-index: 2;
        max-width: 480px;
    }

    .register-brand {
        margin-bottom: 48px;
    }

    .register-brand-icon {
        width: 48px;
        height: 48px;
        background: var(--accent);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 32px;
    }

    .register-brand-icon i {
        color: white;
        font-size: 24px;
    }

    .register-brand h1 {
        font-size: 42px;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 20px;
        color: white;
    }

    .register-brand h1 span {
        color: var(--accent);
    }

    .register-brand p {
        font-size: 18px;
        opacity: 0.8;
        line-height: 1.6;
        margin-bottom: 40px;
    }

    /* Benefits List */
    .benefits-list {
        list-style: none;
        margin-bottom: 48px;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }

    .benefit-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 18px;
        flex-shrink: 0;
    }

    .benefit-text {
        font-size: 16px;
        opacity: 0.9;
    }

    /* Testimonial */
    .testimonial {
        padding: 24px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: var(--radius-lg);
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 40px;
    }

    .testimonial-text {
        font-size: 15px;
        line-height: 1.6;
        opacity: 0.9;
        margin-bottom: 16px;
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .testimonial-author-img {
        width: 40px;
        height: 40px;
        background: var(--accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .testimonial-author-info {
        display: flex;
        flex-direction: column;
    }

    .testimonial-author-name {
        font-weight: 600;
        font-size: 14px;
    }

    .testimonial-author-title {
        font-size: 12px;
        opacity: 0.6;
    }

    /* Stats */
    .register-stats {
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
    .register-right {
        background: var(--white);
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 64px;
        overflow-y: auto;
    }

    .register-form-container {
        width: 100%;
        max-width: 560px;
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

    /* Social Login */
    .social-login {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
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

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 16px;
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .optional-tag {
        font-size: 12px;
        color: var(--text-tertiary);
        font-weight: 400;
        background: var(--off-white);
        padding: 2px 8px;
        border-radius: 100px;
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

    .form-control.is-valid {
        border-color: var(--success);
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

    /* Password Strength */
    .password-strength {
        margin-top: 8px;
    }

    .strength-bar {
        display: flex;
        gap: 4px;
        margin-bottom: 6px;
    }

    .strength-segment {
        height: 4px;
        flex: 1;
        background: var(--border);
        border-radius: 2px;
        transition: all 0.3s;
    }

    .strength-segment.weak { background: var(--error); }
    .strength-segment.fair { background: var(--warning); }
    .strength-segment.good { background: #3b82f6; }
    .strength-segment.strong { background: var(--success); }

    .strength-label {
        font-size: 13px;
        color: var(--text-secondary);
    }

    /* Terms Checkbox */
    .terms-group {
        margin: 24px 0;
        padding: 20px;
        background: var(--off-white);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
    }

    .checkbox-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .checkbox-wrapper input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--accent);
        cursor: pointer;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .checkbox-wrapper label {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.5;
        cursor: pointer;
    }

    .checkbox-wrapper a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
    }

    .checkbox-wrapper a:hover {
        text-decoration: underline;
    }

    /* Submit Button */
    .btn-register {
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-register:hover:not(:disabled) {
        background: var(--accent-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-register:active:not(:disabled) {
        transform: translateY(0);
    }

    .btn-register:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .btn-register.loading {
        color: transparent;
    }

    .btn-register.loading::after {
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

    /* Login Link */
    .login-link {
        margin-top: 28px;
        padding-top: 28px;
        border-top: 1px solid var(--border);
        text-align: center;
    }

    .login-link p {
        color: var(--text-secondary);
        font-size: 15px;
    }

    .login-link a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
        margin-left: 6px;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    /* Terms Note */
    .terms-note {
        margin-top: 20px;
        text-align: center;
        color: var(--text-tertiary);
        font-size: 13px;
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
        .register-page {
            grid-template-columns: 1fr;
        }

        .register-left {
            display: none;
        }

        .register-right {
            padding: 48px 24px;
        }
    }

    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .social-login {
            grid-template-columns: 1fr;
        }

        .register-form-container {
            max-width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="register-page">
    {{-- Left Panel --}}
    <div class="register-left">
        <div class="register-left-bg"></div>
        
        <div class="register-left-content animate">
            <div class="register-brand">
                <div class="register-brand-icon">
                    <i class="bi bi-ticket-perforated"></i>
                </div>
                <h1>Start your <span>journey</span> with us</h1>
                <p>Join thousands of event lovers discovering amazing experiences every day.</p>
            </div>

            <ul class="benefits-list">
                <li class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <span class="benefit-text">Instant ticket booking with no waiting</span>
                </li>
                <li class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-stars"></i>
                    </div>
                    <span class="benefit-text">Personalized event recommendations</span>
                </li>
                <li class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <span class="benefit-text">Exclusive pre-sale access</span>
                </li>
                <li class="benefit-item">
                    <div class="benefit-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <span class="benefit-text">Digital tickets in one place</span>
                </li>
            </ul>

            <div class="testimonial">
                <p class="testimonial-text">
                    "I've discovered so many amazing events through this platform. The booking process is seamless and the recommendations are always spot-on!"
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-author-img">
                        <span>JD</span>
                    </div>
                    <div class="testimonial-author-info">
                        <span class="testimonial-author-name">Jane Doe</span>
                        <span class="testimonial-author-title">Concert Enthusiast</span>
                    </div>
                </div>
            </div>

            <div class="register-stats">
                <div class="stat-item">
                    <span class="stat-number">50K+</span>
                    <span class="stat-label">Happy users</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Monthly events</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">4.9</span>
                    <span class="stat-label">User rating</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Panel --}}
    <div class="register-right">
        <div class="register-form-container animate" style="animation-delay: 0.1s">
            <div class="form-header">
                <h2>Create your account</h2>
                <p>Fill in your details to get started</p>
            </div>

            {{-- Social Registration --}}
            <div class="social-login">
                <a href="{{ route('social.redirect', 'google') }}" class="social-btn">
                    <i class="bi bi-google"></i>
                    Google
                </a>
                <a href="{{ route('social.redirect', 'facebook') }}" class="social-btn">
                    <i class="bi bi-facebook"></i>
                    Facebook
                </a>
            </div>

            <div class="divider">
                <span class="divider-line"></span>
                <span class="divider-text">or register with email</span>
                <span class="divider-line"></span>
            </div>

            {{-- Registration Form --}}
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                {{-- Name Fields --}}
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="first_name">First name</label>
                        <div class="input-wrapper">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   id="first_name"
                                   name="first_name"
                                   value="{{ old('first_name') }}"
                                   placeholder="John"
                                   required>
                        </div>
                        @error('first_name')
                            <span class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="last_name">Last name</label>
                        <div class="input-wrapper">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   id="last_name"
                                   name="last_name"
                                   value="{{ old('last_name') }}"
                                   placeholder="Doe"
                                   required>
                        </div>
                        @error('last_name')
                            <span class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

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
                               placeholder="john@example.com"
                               required>
                    </div>
                    @error('email')
                        <span class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Contact Number --}}
                <div class="form-group">
                    <label class="form-label" for="contact_no">
                        Contact number
                        <span class="optional-tag">Optional</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-phone input-icon"></i>
                        <input type="text"
                               class="form-control @error('contact_no') is-invalid @enderror"
                               id="contact_no"
                               name="contact_no"
                               value="{{ old('contact_no') }}"
                               placeholder="+63 900 000 0000">
                    </div>
                    @error('contact_no')
                        <span class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Password Fields --}}
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   placeholder="Create password"
                                   required>
                            <i class="bi bi-eye password-toggle" id="togglePassword"></i>
                        </div>
                        @error('password')
                            <span class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror

                        {{-- Password Strength --}}
                        <div class="password-strength" id="passwordStrength">
                            <div class="strength-bar">
                                <div class="strength-segment" id="seg1"></div>
                                <div class="strength-segment" id="seg2"></div>
                                <div class="strength-segment" id="seg3"></div>
                                <div class="strength-segment" id="seg4"></div>
                            </div>
                            <span class="strength-label" id="strengthLabel">Enter a password</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password"
                                   class="form-control"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Repeat password"
                                   required>
                            <i class="bi bi-eye password-toggle" id="toggleConfirm"></i>
                        </div>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="terms-group">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">
                            I agree to the <a href="#">Terms of Service</a> and 
                            <a href="#">Privacy Policy</a>. I confirm that I am at least 16 years old.
                        </label>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn-register" id="submitBtn">
                    <i class="bi bi-person-plus"></i>
                    Create Account
                </button>
            </form>

            {{-- Login Link --}}
            <div class="login-link">
                <p>
                    Already have an account?
                    <a href="{{ route('login') }}">Sign in</a>
                </p>
            </div>

            <p class="terms-note">
                By registering, you agree to receive event recommendations. You can unsubscribe at any time.
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
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    document.getElementById('toggleConfirm')?.addEventListener('click', function() {
        const confirm = document.getElementById('password_confirmation');
        const type = confirm.getAttribute('type') === 'password' ? 'text' : 'password';
        confirm.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    // Password strength meter
    const password = document.getElementById('password');
    const segments = [
        document.getElementById('seg1'),
        document.getElementById('seg2'),
        document.getElementById('seg3'),
        document.getElementById('seg4')
    ];
    const strengthLabel = document.getElementById('strengthLabel');

    password?.addEventListener('input', function() {
        const value = this.value;
        let strength = 0;

        // Reset segments
        segments.forEach(seg => {
            seg.className = 'strength-segment';
        });

        if (value.length === 0) {
            strengthLabel.textContent = 'Enter a password';
            return;
        }

        // Check strength criteria
        if (value.length >= 8) strength++;
        if (/[a-z]/.test(value) && /[A-Z]/.test(value)) strength++;
        if (/\d/.test(value)) strength++;
        if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) strength++;

        // Update segments
        for (let i = 0; i < strength; i++) {
            if (strength === 1) segments[i].classList.add('weak');
            else if (strength === 2) segments[i].classList.add('fair');
            else if (strength === 3) segments[i].classList.add('good');
            else if (strength === 4) segments[i].classList.add('strong');
        }

        // Update label
        const labels = ['Very weak', 'Weak', 'Fair', 'Good', 'Strong'];
        strengthLabel.textContent = labels[strength];
    });

    // Confirm password validation
    const confirmPassword = document.getElementById('password_confirmation');
    confirmPassword?.addEventListener('input', function() {
        if (this.value && this.value !== password.value) {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        } else if (this.value && this.value === password.value) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.remove('is-invalid', 'is-valid');
        }
    });

    // Email validation
    const email = document.getElementById('email');
    email?.addEventListener('blur', function() {
        if (this.value) {
            const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value);
            this.classList.toggle('is-valid', isValid);
            this.classList.toggle('is-invalid', !isValid);
        } else {
            this.classList.remove('is-valid', 'is-invalid');
        }
    });

    // Form submission
    document.getElementById('registerForm')?.addEventListener('submit', function(e) {
        const terms = document.getElementById('terms');
        if (!terms.checked) {
            e.preventDefault();
            alert('Please agree to the Terms of Service and Privacy Policy to continue.');
            return;
        }
        
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    });

    // Scroll to top on errors
    @if($errors->any())
        window.scrollTo({ top: 0, behavior: 'smooth' });
    @endif
</script>
@endpush