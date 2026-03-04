@extends('layouts.app')

@section('title', 'Register')

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
        --green-ok: #4cde80;

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
    .register-page {
        min-height: calc(100vh - 80px);
        display: grid;
        grid-template-columns: 1fr 1.4fr;
    }

    /* ── LEFT PANEL ── */
    .register-left {
        background: var(--ink-2);
        border-right: 1px solid var(--line);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 70px 56px;
        position: relative;
        overflow: hidden;
    }

    .register-left-bg {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 60% 50% at 15% 15%, rgba(200,241,53,0.07) 0%, transparent 65%),
            radial-gradient(ellipse 45% 55% at 85% 85%, rgba(200,241,53,0.04) 0%, transparent 60%);
        pointer-events: none;
    }

    .register-left-deco {
        font-family: var(--font-display);
        font-size: clamp(6rem, 11vw, 11rem);
        font-weight: 900;
        font-style: italic;
        line-height: 1;
        color: transparent;
        -webkit-text-stroke: 1px var(--line);
        user-select: none;
        position: absolute;
        bottom: 50px;
        left: 40px;
        opacity: 0.45;
        letter-spacing: -0.04em;
    }

    .register-brand { position: relative; z-index: 2; }

    .register-brand-eyebrow {
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

    .register-brand-eyebrow::before {
        content: '';
        display: inline-block;
        width: 28px; height: 2px;
        background: var(--volt);
    }

    .register-brand h2 {
        font-family: var(--font-display);
        font-size: clamp(2rem, 3vw, 3rem);
        font-weight: 900;
        color: var(--chalk);
        letter-spacing: -0.02em;
        line-height: 1.1;
        margin-bottom: 20px;
    }

    .register-brand h2 em {
        font-style: italic;
        color: var(--volt);
    }

    .register-brand p {
        font-size: 0.9rem;
        color: var(--chalk-3);
        line-height: 1.65;
        font-weight: 300;
        max-width: 300px;
    }

    /* perks list */
    .perks-list {
        position: relative;
        z-index: 2;
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-top: 40px;
    }

    .perks-list li {
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 0.85rem;
        color: var(--chalk-2);
        font-weight: 300;
    }

    .perks-list li::before {
        content: '';
        display: inline-block;
        width: 20px; height: 20px;
        background: rgba(200,241,53,0.12);
        border: 1px solid var(--volt);
        flex-shrink: 0;
        position: relative;
    }

    .perks-list li i {
        position: absolute;
        font-size: 0.55rem;
        color: var(--volt);
        margin-left: -17px;
        margin-top: 4px;
    }

    .register-left-footer { position: relative; z-index: 2; }

    .already-member {
        font-family: var(--font-mono);
        font-size: 0.62rem;
        letter-spacing: 0.15em;
        color: var(--chalk-3);
    }

    .already-member a {
        color: var(--volt);
        text-decoration: none;
        border-bottom: 1px solid rgba(200,241,53,0.35);
        padding-bottom: 1px;
        transition: border-color 0.2s;
    }

    .already-member a:hover { border-color: var(--volt); color: var(--volt) !important; }

    /* ── RIGHT PANEL ── */
    .register-right {
        background: var(--ink);
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 70px 64px;
        overflow-y: auto;
    }

    .register-form-wrap {
        width: 100%;
        max-width: 520px;
        animation: fadeUp 0.7s cubic-bezier(0.2,0,0.3,1) both;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── FORM HEADER ── */
    .form-header { margin-bottom: 40px; }

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
        width: 20px; height: 2px;
        background: var(--volt);
    }

    .form-header h1 {
        font-family: var(--font-display);
        font-size: 2.2rem;
        font-weight: 900;
        color: var(--chalk);
        letter-spacing: -0.02em;
        line-height: 1.1;
        margin-bottom: 10px;
    }

    .form-header p {
        font-size: 0.88rem;
        color: var(--chalk-3);
        font-weight: 300;
    }

    /* ── SOCIAL ROW ── */
    .social-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 28px;
    }

    .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px;
        background: var(--ink-2);
        border: 1px solid var(--line);
        color: var(--chalk-2);
        text-decoration: none;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        transition: all 0.2s;
    }

    .social-btn:hover {
        background: var(--ink-3);
        border-color: var(--volt);
        color: var(--volt) !important;
    }

    .social-btn i { font-size: 0.85rem; }

    /* ── DIVIDER ── */
    .or-divider {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 28px;
    }

    .or-divider::before, .or-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--line);
    }

    .or-divider span {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--chalk-3);
        white-space: nowrap;
    }

    /* ── FIELD GROUPS ── */
    .fields-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .field-group { margin-bottom: 16px; }

    .field-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--chalk-3);
        margin-bottom: 9px;
    }

    .field-label .optional-tag {
        font-size: 0.55rem;
        color: var(--chalk-3);
        background: var(--ink-3);
        border: 1px solid var(--line);
        padding: 2px 8px;
        letter-spacing: 0.1em;
    }

    .field-wrap { position: relative; }

    .field-wrap i.field-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.75rem;
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
        font-size: 0.92rem;
        padding: 15px 18px 15px 42px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        border-radius: 0;
        -webkit-appearance: none;
    }

    .form-control:focus {
        border-color: var(--volt);
        box-shadow: 0 0 0 3px rgba(200,241,53,0.07);
        background: var(--ink-3);
        color: var(--chalk);
    }

    .form-control:focus ~ .field-icon,
    .field-wrap:focus-within i.field-icon { color: var(--volt); }

    .form-control::placeholder { color: var(--chalk-3); }

    .form-control.is-invalid {
        border-color: var(--red-err);
        box-shadow: 0 0 0 3px rgba(255,79,79,0.07);
        background-image: none;
    }

    .form-control.is-valid {
        border-color: var(--green-ok);
        box-shadow: 0 0 0 3px rgba(76,222,128,0.06);
    }

    .invalid-feedback {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.08em;
        color: var(--red-err);
        margin-top: 7px;
        display: block;
    }

    /* password toggle */
    .toggle-pass {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--chalk-3);
        cursor: pointer;
        font-size: 0.8rem;
        transition: color 0.2s;
        z-index: 3;
    }

    .toggle-pass:hover { color: var(--volt); }

    /* ── PASSWORD STRENGTH ── */
    .strength-wrap { margin-top: 10px; }

    .strength-bar {
        display: flex;
        gap: 4px;
        margin-bottom: 6px;
    }

    .strength-seg {
        height: 3px;
        flex: 1;
        background: var(--line);
        transition: background 0.3s;
    }

    .strength-seg.s1 { background: var(--red-err); }
    .strength-seg.s2 { background: #f5a623; }
    .strength-seg.s3 { background: #f5d623; }
    .strength-seg.s4 { background: var(--green-ok); }

    .strength-label {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--chalk-3);
    }

    /* ── TERMS ── */
    .terms-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin: 22px 0;
        padding: 18px;
        background: var(--ink-2);
        border: 1px solid var(--line);
    }

    .terms-row input[type="checkbox"] {
        width: 15px;
        height: 15px;
        accent-color: var(--volt);
        cursor: pointer;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .terms-row label {
        font-size: 0.82rem;
        color: var(--chalk-3);
        line-height: 1.6;
        cursor: pointer;
        font-weight: 300;
    }

    .terms-row a {
        color: var(--chalk);
        text-decoration: none;
        border-bottom: 1px solid var(--line);
        transition: color 0.2s, border-color 0.2s;
    }

    .terms-row a:hover { color: var(--volt) !important; border-color: var(--volt); }

    /* ── SUBMIT ── */
    .btn-register {
        width: 100%;
        background: var(--volt);
        color: var(--ink);
        border: none;
        padding: 18px 24px;
        font-family: var(--font-mono);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s;
        position: relative;
        overflow: hidden;
    }

    .btn-register:hover { background: #d4f545; }
    .btn-register:active { background: var(--volt-dim); }

    .btn-register.loading { pointer-events: none; opacity: 0.75; }
    .btn-register.loading .btn-text { visibility: hidden; }
    .btn-register.loading::after {
        content: '';
        position: absolute;
        width: 18px; height: 18px;
        top: 50%; left: 50%;
        margin: -9px 0 0 -9px;
        border: 2px solid rgba(10,10,15,0.25);
        border-top-color: var(--ink);
        border-radius: 50%;
        animation: spin 0.7s linear infinite;
    }

    @keyframes spin { to { transform: rotate(360deg); } }

    /* ── LOGIN LINK ── */
    .login-row {
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--line);
        text-align: center;
    }

    .login-row p { font-size: 0.84rem; color: var(--chalk-3); }

    .login-row a {
        color: var(--chalk);
        text-decoration: none;
        font-weight: 600;
        border-bottom: 1px solid var(--volt);
        padding-bottom: 1px;
        transition: color 0.2s;
    }

    .login-row a:hover { color: var(--volt) !important; }

    .terms-note {
        margin-top: 16px;
        text-align: center;
        font-family: var(--font-mono);
        font-size: 0.56rem;
        letter-spacing: 0.08em;
        color: var(--chalk-3);
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
        .register-page { grid-template-columns: 1fr; }
        .register-left { display: none; }
        .register-right { padding: 50px 28px; }
    }

    @media (max-width: 600px) {
        .fields-row { grid-template-columns: 1fr; }
        .social-row { grid-template-columns: repeat(3, 1fr); }
    }
</style>
@endpush

@section('content')
<div class="register-page">

    {{-- ── LEFT PANEL ── --}}
    <div class="register-left">
        <div class="register-left-bg"></div>

        <div class="register-brand">
            <div class="register-brand-eyebrow">Live Events Platform</div>
            <h2>Start Your<br><em>Journey</em><br>Today.</h2>
            <p>Create a free account and unlock access to hundreds of events across the country.</p>

            <ul class="perks-list" style="margin-top: 32px;">
                <li><i class="fas fa-check"></i> Instant ticket booking, no waiting</li>
                <li><i class="fas fa-check"></i> Personalised event recommendations</li>
                <li><i class="fas fa-check"></i> Exclusive pre-sale access</li>
                <li><i class="fas fa-check"></i> Order history & digital tickets</li>
            </ul>
        </div>

        <div class="register-left-footer">
            <p class="already-member">Already a member? <a href="{{ route('login') }}">Sign in &rarr;</a></p>
        </div>

        <div class="register-left-deco">Join</div>
    </div>

    {{-- ── RIGHT PANEL ── --}}
    <div class="register-right">
        <div class="register-form-wrap">

            {{-- Header --}}
            <div class="form-header">
                <div class="form-header-eyebrow">New Account</div>
                <h1>Create Your<br>Account.</h1>
                <p>Fill in your details below — it takes less than a minute.</p>
            </div>

            {{-- Social --}}
            <div class="social-row">
                <a href="#" class="social-btn"><i class="fab fa-google"></i> Google</a>
                <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#" class="social-btn"><i class="fab fa-twitter"></i> Twitter</a>
            </div>

            <div class="or-divider"><span>Or register with email</span></div>

            {{-- Form --}}
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                {{-- Name Row --}}
                <div class="fields-row">
                    <div class="field-group">
                        <label class="field-label" for="first_name">First Name</label>
                        <div class="field-wrap">
                            <i class="fas fa-user field-icon"></i>
                            <input type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   id="first_name" name="first_name"
                                   value="{{ old('first_name') }}"
                                   placeholder="First name" required>
                        </div>
                        @error('first_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="last_name">Last Name</label>
                        <div class="field-wrap">
                            <i class="fas fa-user field-icon"></i>
                            <input type="text"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   id="last_name" name="last_name"
                                   value="{{ old('last_name') }}"
                                   placeholder="Last name" required>
                        </div>
                        @error('last_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="field-group">
                    <label class="field-label" for="email">Email Address</label>
                    <div class="field-wrap">
                        <i class="fas fa-envelope field-icon"></i>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="you@example.com" required>
                    </div>
                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                {{-- Contact --}}
                <div class="field-group">
                    <label class="field-label" for="contact_no">
                        Contact Number
                        <span class="optional-tag">Optional</span>
                    </label>
                    <div class="field-wrap">
                        <i class="fas fa-phone field-icon"></i>
                        <input type="text"
                               class="form-control @error('contact_no') is-invalid @enderror"
                               id="contact_no" name="contact_no"
                               value="{{ old('contact_no') }}"
                               placeholder="+63 900 000 0000">
                    </div>
                    @error('contact_no')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                {{-- Password Row --}}
                <div class="fields-row">
                    <div class="field-group">
                        <label class="field-label" for="password">Password</label>
                        <div class="field-wrap">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password"
                                   placeholder="Create password" required>
                            <i class="fas fa-eye toggle-pass" id="togglePassword"></i>
                        </div>
                        @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror

                        <div class="strength-wrap">
                            <div class="strength-bar">
                                <div class="strength-seg" id="seg1"></div>
                                <div class="strength-seg" id="seg2"></div>
                                <div class="strength-seg" id="seg3"></div>
                                <div class="strength-seg" id="seg4"></div>
                            </div>
                            <span class="strength-label" id="strengthLabel">—</span>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="password_confirmation">Confirm</label>
                        <div class="field-wrap">
                            <i class="fas fa-lock field-icon"></i>
                            <input type="password"
                                   class="form-control"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Repeat password" required>
                            <i class="fas fa-eye toggle-pass" id="toggleConfirm"></i>
                        </div>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="terms-row">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        I agree to the <a href="#">Terms of Service</a> and
                        <a href="#">Privacy Policy</a>. I confirm I am at least 16 years old.
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-register" id="submitBtn">
                    <span class="btn-text">
                        <i class="fas fa-arrow-right me-2"></i>Create Account
                    </span>
                </button>
            </form>

            <div class="login-row">
                <p>Already have an account? <a href="{{ route('login') }}">Sign in &rarr;</a></p>
            </div>

            <p class="terms-note">
                By registering you agree to receive event notifications. Unsubscribe any time.
            </p>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // ── Password toggles
    function makeToggle(btnId, inputId) {
        document.getElementById(btnId).addEventListener('click', function () {
            const el = document.getElementById(inputId);
            const hidden = el.type === 'password';
            el.type = hidden ? 'text' : 'password';
            this.classList.toggle('fa-eye', !hidden);
            this.classList.toggle('fa-eye-slash', hidden);
        });
    }
    makeToggle('togglePassword', 'password');
    makeToggle('toggleConfirm', 'password_confirmation');

    // ── Password strength
    const pw = document.getElementById('password');
    const segs = [null, document.getElementById('seg1'), document.getElementById('seg2'),
                  document.getElementById('seg3'), document.getElementById('seg4')];
    const strengthLabel = document.getElementById('strengthLabel');
    const labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];
    const classes = ['', 's1', 's2', 's3', 's4'];

    pw.addEventListener('input', function () {
        const v = this.value;
        let score = 0;
        if (v.length >= 8)                                   score++;
        if (/\d/.test(v))                                    score++;
        if (/[a-z]/.test(v) && /[A-Z]/.test(v))             score++;
        if (/[!@#$%^&*(),.?":{}|<>]/.test(v))               score++;

        segs.forEach((s, i) => {
            if (!s) return;
            s.className = 'strength-seg';
            if (i <= score && v.length > 0) s.classList.add(classes[score]);
        });

        strengthLabel.textContent = v.length ? labels[score] : '—';
    });

    // ── Confirm password match highlight
    const confirmPw = document.getElementById('password_confirmation');
    confirmPw.addEventListener('input', function () {
        if (!this.value) { this.className = 'form-control'; return; }
        this.className = 'form-control ' + (this.value === pw.value ? 'is-valid' : 'is-invalid');
    });

    // ── Email live validation
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('blur', function () {
        if (!this.value) return;
        const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value);
        this.className = 'form-control ' + (ok ? 'is-valid' : 'is-invalid');
    });

    // ── Icon focus colour
    document.querySelectorAll('.form-control').forEach(input => {
        const icon = input.closest('.field-wrap')?.querySelector('.field-icon');
        if (!icon) return;
        input.addEventListener('focus', () => icon.style.color = 'var(--volt)');
        input.addEventListener('blur',  () => icon.style.color = '');
    });

    // ── Submit loading
    document.getElementById('registerForm').addEventListener('submit', function (e) {
        if (!document.getElementById('terms').checked) {
            e.preventDefault();
            return;
        }
        document.getElementById('submitBtn').classList.add('loading');
    });

    @if($errors->any())
        window.scrollTo({ top: 0, behavior: 'smooth' });
    @endif
</script>
@endpush