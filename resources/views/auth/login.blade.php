@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

<style>
    :root {
        --ink:      #0a0a0f;
        --ink-2:    #13131a;
        --ink-3:    #1e1e28;
        --ink-4:    #2a2a38;
        --line:     #2e2e3e;
        --volt:     #c8f135;
        --volt-dim: #9fbd28;
        --chalk:    #f0ede6;
        --chalk-2:  #b8b4ac;
        --chalk-3:  #706c66;
        --red-err:  #ff4f4f;

        --font-display: 'Playfair Display', Georgia, serif;
        --font-body:    'DM Sans', sans-serif;
        --font-mono:    'Space Mono', monospace;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        background-color: var(--ink);
        color: var(--chalk);
        font-family: var(--font-body);
        -webkit-font-smoothing: antialiased;
        min-height: 100vh;
    }

    /* noise */
    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 9999;
        opacity: 0.6;
    }

    /* ── PAGE LAYOUT ── */
    .login-page {
        min-height: calc(100vh - 80px);
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    /* ── LEFT PANEL ── */
    .login-left {
        background: var(--ink-2);
        border-right: 1px solid var(--line);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 70px 64px;
        position: relative;
        overflow: hidden;
    }

    .login-left-bg {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 55% 45% at 20% 20%, rgba(200,241,53,0.06) 0%, transparent 65%),
            radial-gradient(ellipse 40% 55% at 80% 80%, rgba(200,241,53,0.04) 0%, transparent 60%);
        pointer-events: none;
    }

    /* large decorative character */
    .login-left-deco {
        font-family: var(--font-display);
        font-size: clamp(7rem, 14vw, 13rem);
        font-weight: 900;
        font-style: italic;
        line-height: 1;
        color: transparent;
        -webkit-text-stroke: 1px var(--line);
        user-select: none;
        position: absolute;
        bottom: 60px;
        left: 50px;
        opacity: 0.5;
        letter-spacing: -0.04em;
    }

    .login-brand {
        position: relative;
        z-index: 2;
    }

    .login-brand-eyebrow {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--volt);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .login-brand-eyebrow::before {
        content: '';
        display: inline-block;
        width: 28px;
        height: 2px;
        background: var(--volt);
    }

    .login-brand h2 {
        font-family: var(--font-display);
        font-size: clamp(2.2rem, 3.5vw, 3.4rem);
        font-weight: 900;
        color: var(--chalk);
        letter-spacing: -0.02em;
        line-height: 1.1;
        margin-bottom: 20px;
    }

    .login-brand h2 em {
        font-style: italic;
        color: var(--volt);
    }

    .login-brand p {
        font-size: 0.95rem;
        color: var(--chalk-3);
        line-height: 1.65;
        font-weight: 300;
        max-width: 340px;
    }

    .login-left-footer {
        position: relative;
        z-index: 2;
    }

    .login-left-footer-label {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--chalk-3);
        margin-bottom: 10px;
    }

    .login-left-stats {
        display: flex;
        gap: 40px;
    }

    .login-left-stat-num {
        font-family: var(--font-display);
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--chalk);
        line-height: 1;
    }

    .login-left-stat-label {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--chalk-3);
        margin-top: 4px;
    }

    /* ── RIGHT PANEL (FORM) ── */
    .login-right {
        background: var(--ink);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 70px 64px;
    }

    .login-form-wrap {
        width: 100%;
        max-width: 400px;
        animation: fadeUp 0.7s cubic-bezier(0.2,0,0.3,1) both;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── FORM HEADER ── */
    .form-header {
        margin-bottom: 44px;
    }

    .form-header-eyebrow {
        font-family: var(--font-mono);
        font-size: 0.62rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--volt);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-header-eyebrow::before {
        content: '';
        display: inline-block;
        width: 20px;
        height: 2px;
        background: var(--volt);
    }

    .form-header h1 {
        font-family: var(--font-display);
        font-size: 2.4rem;
        font-weight: 900;
        color: var(--chalk);
        letter-spacing: -0.02em;
        line-height: 1.1;
        margin-bottom: 10px;
    }

    .form-header p {
        font-size: 0.9rem;
        color: var(--chalk-3);
        font-weight: 300;
    }

    /* ── SOCIAL BUTTONS ── */
    .social-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 32px;
    }

    .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px;
        background: var(--ink-2);
        border: 1px solid var(--line);
        color: var(--chalk-2);
        text-decoration: none;
        font-family: var(--font-mono);
        font-size: 0.68rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        transition: all 0.2s;
    }

    .social-btn:hover {
        background: var(--ink-3);
        border-color: var(--volt);
        color: var(--volt) !important;
    }

    .social-btn i { font-size: 0.9rem; }

    /* ── DIVIDER ── */
    .or-divider {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 32px;
    }

    .or-divider::before,
    .or-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--line);
    }

    .or-divider span {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--chalk-3);
        white-space: nowrap;
    }

    /* ── FORM FIELDS ── */
    .field-group {
        margin-bottom: 20px;
    }

    .field-label {
        display: block;
        font-family: var(--font-mono);
        font-size: 0.62rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--chalk-3);
        margin-bottom: 10px;
    }

    .field-wrap {
        position: relative;
    }

    .field-wrap i.field-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.8rem;
        color: var(--chalk-3);
        pointer-events: none;
        transition: color 0.2s;
        z-index: 2;
    }

    .form-control {
        width: 100%;
        background: var(--ink-2);
        border: 1px solid var(--line);
        color: var(--chalk);
        font-family: var(--font-body);
        font-size: 0.95rem;
        padding: 16px 18px 16px 46px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        border-radius: 0;
        height: auto;
        -webkit-appearance: none;
    }

    .form-control:focus {
        border-color: var(--volt);
        box-shadow: 0 0 0 3px rgba(200,241,53,0.07);
        background: var(--ink-3);
        color: var(--chalk);
    }

    .form-control:focus + .field-icon,
    .field-wrap:focus-within i.field-icon {
        color: var(--volt);
    }

    .form-control::placeholder { color: var(--chalk-3); }

    .form-control.is-invalid {
        border-color: var(--red-err);
        box-shadow: 0 0 0 3px rgba(255,79,79,0.07);
        background-image: none;
    }

    .invalid-feedback {
        font-family: var(--font-mono);
        font-size: 0.62rem;
        letter-spacing: 0.08em;
        color: var(--red-err);
        margin-top: 8px;
        display: block;
    }

    /* Password toggle */
    .toggle-pass {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--chalk-3);
        cursor: pointer;
        font-size: 0.85rem;
        transition: color 0.2s;
        z-index: 3;
    }

    .toggle-pass:hover { color: var(--volt); }

    /* ── OPTIONS ROW ── */
    .options-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        margin-top: 4px;
    }

    .remember-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .remember-wrap input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: var(--volt);
        cursor: pointer;
        background: var(--ink-2);
        border: 1px solid var(--line);
    }

    .remember-wrap label {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--chalk-3);
        cursor: pointer;
    }

    .forgot-link {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--chalk-3);
        text-decoration: none;
        border-bottom: 1px solid var(--line);
        padding-bottom: 2px;
        transition: color 0.2s, border-color 0.2s;
    }

    .forgot-link:hover {
        color: var(--volt) !important;
        border-color: var(--volt);
    }

    /* ── SUBMIT BUTTON ── */
    .btn-login {
        width: 100%;
        background: var(--volt);
        color: var(--ink);
        border: none;
        padding: 18px 24px;
        font-family: var(--font-mono);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s;
        position: relative;
        overflow: hidden;
    }

    .btn-login:hover { background: #d4f545; }

    .btn-login:active { background: var(--volt-dim); }

    .btn-login.loading {
        pointer-events: none;
        opacity: 0.75;
    }

    .btn-login.loading .btn-text { visibility: hidden; }

    .btn-login.loading::after {
        content: '';
        position: absolute;
        width: 18px;
        height: 18px;
        top: 50%; left: 50%;
        margin: -9px 0 0 -9px;
        border: 2px solid rgba(10,10,15,0.3);
        border-top-color: var(--ink);
        border-radius: 50%;
        animation: spin 0.7s linear infinite;
    }

    @keyframes spin { to { transform: rotate(360deg); } }

    /* ── REGISTER LINK ── */
    .register-row {
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid var(--line);
        text-align: center;
    }

    .register-row p {
        font-size: 0.85rem;
        color: var(--chalk-3);
    }

    .register-row a {
        color: var(--chalk);
        text-decoration: none;
        font-weight: 600;
        border-bottom: 1px solid var(--volt);
        padding-bottom: 1px;
        transition: color 0.2s;
    }

    .register-row a:hover { color: var(--volt) !important; }

    /* ── TERMS ── */
    .terms-note {
        margin-top: 18px;
        text-align: center;
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.08em;
        color: var(--chalk-3);
    }

    .terms-note a {
        color: var(--chalk-3);
        text-decoration: underline;
        transition: color 0.2s;
    }

    .terms-note a:hover { color: var(--chalk) !important; }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .login-page { grid-template-columns: 1fr; }
        .login-left  { display: none; }
        .login-right { padding: 50px 28px; }
    }
</style>
@endpush

@section('content')
<div class="login-page">

    {{-- ── LEFT PANEL ── --}}
    <div class="login-left">
        <div class="login-left-bg"></div>

        <div class="login-brand">
            <div class="login-brand-eyebrow">Live Events Platform</div>
            <h2>Your Next<br><em>Great Night</em><br>Awaits.</h2>
            <p>Discover and book the best events in your city — concerts, sports, arts, food, and more.</p>
        </div>

        <div class="login-left-footer">
            <div class="login-left-footer-label">Trusted by</div>
            <div class="login-left-stats">
                <div>
                    <div class="login-left-stat-num">50K+</div>
                    <div class="login-left-stat-label">Customers</div>
                </div>
                <div>
                    <div class="login-left-stat-num">500+</div>
                    <div class="login-left-stat-label">Events</div>
                </div>
                <div>
                    <div class="login-left-stat-num">100+</div>
                    <div class="login-left-stat-label">Cities</div>
                </div>
            </div>
        </div>

        <div class="login-left-deco">Login</div>
    </div>

    {{-- ── RIGHT PANEL ── --}}
    <div class="login-right">
        <div class="login-form-wrap">

            {{-- Header --}}
            <div class="form-header">
                <div class="form-header-eyebrow">Sign In</div>
                <h1>Welcome<br>Back.</h1>
                <p>Enter your credentials to access your account.</p>
            </div>

            {{-- Social --}}
            <div class="social-row">
                <a href="#" class="social-btn">
                    <i class="fab fa-google"></i> Google
                </a>
                <a href="#" class="social-btn">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                <a href="#" class="social-btn">
                    <i class="fab fa-twitter"></i> Twitter
                </a>
            </div>

            <div class="or-divider">
                <span>Or continue with email</span>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                {{-- Email --}}
                <div class="field-group">
                    <label class="field-label" for="email">Email Address</label>
                    <div class="field-wrap">
                        <i class="fas fa-envelope field-icon"></i>
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
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="field-group">
                    <label class="field-label" for="password">Password</label>
                    <div class="field-wrap">
                        <i class="fas fa-lock field-icon"></i>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="••••••••"
                               required>
                        <i class="fas fa-eye toggle-pass" id="togglePassword"></i>
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Options --}}
                <div class="options-row">
                    <div class="remember-wrap">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login" id="submitBtn">
                    <span class="btn-text">
                        <i class="fas fa-arrow-right me-2"></i>Sign In
                    </span>
                </button>
            </form>

            {{-- Register --}}
            <div class="register-row">
                <p>No account yet? <a href="{{ route('register') }}">Create one &rarr;</a></p>
            </div>

            <p class="terms-note">
                By signing in you agree to our
                <a href="#">Terms of Service</a> and
                <a href="#">Privacy Policy</a>.
            </p>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Password toggle
    document.getElementById('togglePassword').addEventListener('click', function () {
        const pw = document.getElementById('password');
        const isHidden = pw.type === 'password';
        pw.type = isHidden ? 'text' : 'password';
        this.classList.toggle('fa-eye', !isHidden);
        this.classList.toggle('fa-eye-slash', isHidden);
    });

    // Loading state on submit
    document.getElementById('loginForm').addEventListener('submit', function () {
        document.getElementById('submitBtn').classList.add('loading');
    });

    // Icon color sync on focus
    document.querySelectorAll('.form-control').forEach(input => {
        const icon = input.closest('.field-wrap')?.querySelector('.field-icon');
        if (!icon) return;
        input.addEventListener('focus',  () => icon.style.color = 'var(--volt)');
        input.addEventListener('blur',   () => icon.style.color = '');
    });

    @if($errors->any())
        window.scrollTo({ top: 0, behavior: 'smooth' });
    @endif
</script>
@endpush