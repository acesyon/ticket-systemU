@extends('layouts.app')

@section('title', 'My Profile')

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
        --red-hot:  #ff3f3f;
        --green-ok: #4cde80;
        --amber:    #f5a623;

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

    /* ── PAGE HEADER ── */
    .profile-header {
        background: var(--ink-2);
        border-bottom: 1px solid var(--line);
        padding: 56px 0 40px;
        margin-top: -24px;
    }

    .profile-header-eyebrow {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--volt);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile-header-eyebrow::before {
        content: '';
        display: inline-block;
        width: 28px; height: 2px;
        background: var(--volt);
    }

    .profile-header h1 {
        font-family: var(--font-display);
        font-size: clamp(2.4rem, 4vw, 3.8rem);
        font-weight: 900;
        color: var(--chalk);
        letter-spacing: -0.02em;
        line-height: 1.0;
    }

    .profile-header h1 em {
        font-style: italic;
        color: var(--volt);
    }

    .profile-header-sub {
        font-size: 0.9rem;
        color: var(--chalk-3);
        font-weight: 300;
        margin-top: 10px;
    }

    /* ── LAYOUT ── */
    .profile-body {
        padding: 0;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1px;
        background: var(--line);
        border: 1px solid var(--line);
        border-top: none;
    }

    /* ── PANEL ── */
    .profile-panel {
        background: var(--ink);
        padding: 0;
    }

    .profile-panel.right { background: var(--ink); }

    .panel-head {
        padding: 22px 32px;
        background: var(--ink-2);
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .panel-head-icon {
        width: 32px; height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        flex-shrink: 0;
    }

    .panel-head-icon.volt  { background: rgba(200,241,53,0.12); color: var(--volt); border: 1px solid rgba(200,241,53,0.25); }
    .panel-head-icon.amber { background: rgba(245,166,35,0.1);  color: var(--amber); border: 1px solid rgba(245,166,35,0.25); }
    .panel-head-icon.red   { background: rgba(255,63,63,0.1);   color: var(--red-hot); border: 1px solid rgba(255,63,63,0.25); }

    .panel-head-text {
        flex: 1;
    }

    .panel-head-label {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--chalk-3);
        margin-bottom: 3px;
    }

    .panel-head-title {
        font-family: var(--font-display);
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--chalk);
        letter-spacing: -0.01em;
    }

    .panel-body { padding: 32px; }

    /* ── FORM FIELDS ── */
    .field-group { margin-bottom: 20px; }

    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 20px;
    }

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
        letter-spacing: 0.08em;
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
        padding: 14px 16px 14px 42px;
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

    .field-wrap:focus-within i.field-icon { color: var(--volt); }

    .form-control::placeholder { color: var(--chalk-3); }

    .form-control.is-invalid {
        border-color: var(--red-hot);
        box-shadow: 0 0 0 3px rgba(255,63,63,0.07);
        background-image: none;
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
        z-index: 3;
        transition: color 0.2s;
    }

    .toggle-pass:hover { color: var(--volt); }

    .invalid-feedback {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.08em;
        color: var(--red-hot);
        margin-top: 7px;
        display: block;
    }

    /* ── SUBMIT BUTTONS ── */
    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--volt);
        color: var(--ink);
        border: none;
        padding: 14px 32px;
        font-family: var(--font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s;
        margin-top: 8px;
    }

    .btn-save:hover { background: #d4f545; }

    .btn-change-pw {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: var(--amber);
        border: 1px solid rgba(245,166,35,0.4);
        padding: 14px 32px;
        font-family: var(--font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 8px;
    }

    .btn-change-pw:hover {
        background: rgba(245,166,35,0.1);
        border-color: var(--amber);
    }

    /* ── DANGER ZONE ── */
    .danger-zone {
        background: var(--ink);
        border-top: 1px solid var(--line);
        padding: 28px 32px;
    }

    .danger-zone-label {
        font-family: var(--font-mono);
        font-size: 0.58rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--red-hot);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .danger-zone-label::before {
        content: '';
        display: inline-block;
        width: 16px; height: 1px;
        background: var(--red-hot);
    }

    .danger-zone p {
        font-size: 0.84rem;
        color: var(--chalk-3);
        margin-bottom: 18px;
        line-height: 1.6;
        font-weight: 300;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: var(--red-hot);
        border: 1px solid rgba(255,63,63,0.35);
        padding: 12px 24px;
        font-family: var(--font-mono);
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-delete:hover {
        background: rgba(255,63,63,0.1);
        border-color: var(--red-hot);
    }

    /* ── MODAL ── */
    .modal-backdrop-custom {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.75);
        z-index: 1000;
        backdrop-filter: blur(4px);
    }

    .modal-backdrop-custom.open { display: flex; align-items: center; justify-content: center; }

    .modal-box {
        background: var(--ink-2);
        border: 1px solid var(--line);
        width: 100%;
        max-width: 480px;
        margin: 20px;
        animation: fadeUp 0.3s cubic-bezier(0.2,0,0.3,1);
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .modal-head {
        padding: 22px 28px;
        background: rgba(255,63,63,0.08);
        border-bottom: 1px solid rgba(255,63,63,0.2);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-head-title {
        font-family: var(--font-display);
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--red-hot);
        letter-spacing: -0.01em;
    }

    .modal-close {
        background: none;
        border: none;
        color: var(--chalk-3);
        font-size: 0.9rem;
        cursor: pointer;
        transition: color 0.2s;
        padding: 4px 8px;
    }

    .modal-close:hover { color: var(--chalk); }

    .modal-body-inner { padding: 28px; }

    .modal-warning {
        display: flex;
        gap: 14px;
        padding: 16px;
        background: rgba(255,63,63,0.06);
        border: 1px solid rgba(255,63,63,0.2);
        margin-bottom: 24px;
    }

    .modal-warning i {
        color: var(--red-hot);
        font-size: 1rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .modal-warning p {
        font-size: 0.88rem;
        color: var(--chalk-2);
        line-height: 1.55;
    }

    .modal-footer-inner {
        padding: 20px 28px;
        border-top: 1px solid var(--line);
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-modal-cancel {
        background: transparent;
        border: 1px solid var(--line);
        color: var(--chalk-3);
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        padding: 12px 20px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-modal-cancel:hover {
        border-color: var(--chalk-3);
        color: var(--chalk);
    }

    .btn-modal-confirm {
        background: var(--red-hot);
        border: none;
        color: white;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        padding: 12px 24px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-modal-confirm:hover { background: #e63535; }

    /* ── ANIMATIONS ── */
    .anim { opacity: 0; }
    .anim.visible { animation: fadeUp 0.55s cubic-bezier(0.2,0,0.3,1) forwards; }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .profile-grid { grid-template-columns: 1fr; }
        .field-row { grid-template-columns: 1fr; }
    }

    @media (max-width: 480px) {
        .panel-body { padding: 20px; }
        .danger-zone { padding: 20px; }
    }
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="profile-header">
    <div class="container-fluid px-4 px-lg-5">
        <div class="profile-header-eyebrow">Account</div>
        <h1>My <em>Profile.</em></h1>
        <p class="profile-header-sub">
            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
            &nbsp;·&nbsp; {{ auth()->user()->email }}
        </p>
    </div>
</div>

<div class="profile-body">
    <div class="container-fluid px-4 px-lg-5">
        <div class="profile-grid">

            {{-- ── LEFT: Profile Info ── --}}
            <div class="profile-panel anim">

                <div class="panel-head">
                    <div class="panel-head-icon volt"><i class="fas fa-user"></i></div>
                    <div class="panel-head-text">
                        <div class="panel-head-label">Edit Details</div>
                        <div class="panel-head-title">Profile Information</div>
                    </div>
                </div>

                <div class="panel-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        {{-- Name row --}}
                        <div class="field-row">
                            <div>
                                <label class="field-label" for="first_name">First Name</label>
                                <div class="field-wrap">
                                    <i class="fas fa-user field-icon"></i>
                                    <input type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           id="first_name" name="first_name"
                                           value="{{ old('first_name', auth()->user()->first_name) }}"
                                           placeholder="First name" required>
                                </div>
                                @error('first_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div>
                                <label class="field-label" for="last_name">Last Name</label>
                                <div class="field-wrap">
                                    <i class="fas fa-user field-icon"></i>
                                    <input type="text"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           id="last_name" name="last_name"
                                           value="{{ old('last_name', auth()->user()->last_name) }}"
                                           placeholder="Last name" required>
                                </div>
                                @error('last_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        {{-- Middle name --}}
                        <div class="field-group">
                            <label class="field-label" for="middle_name">
                                Middle Name
                                <span class="optional-tag">Optional</span>
                            </label>
                            <div class="field-wrap">
                                <i class="fas fa-user field-icon"></i>
                                <input type="text"
                                       class="form-control @error('middle_name') is-invalid @enderror"
                                       id="middle_name" name="middle_name"
                                       value="{{ old('middle_name', auth()->user()->middle_name) }}"
                                       placeholder="Middle name">
                            </div>
                            @error('middle_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        {{-- Email --}}
                        <div class="field-group">
                            <label class="field-label" for="email">Email Address</label>
                            <div class="field-wrap">
                                <i class="fas fa-envelope field-icon"></i>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email"
                                       value="{{ old('email', auth()->user()->email) }}"
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
                                       value="{{ old('contact_no', auth()->user()->contact_no) }}"
                                       placeholder="+63 900 000 0000">
                            </div>
                            @error('contact_no')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Save Changes
                        </button>

                    </form>
                </div>
            </div>

            {{-- ── RIGHT: Password + Delete ── --}}
            <div class="profile-panel right anim" style="animation-delay: 0.07s">

                {{-- Change password --}}
                <div class="panel-head">
                    <div class="panel-head-icon amber"><i class="fas fa-key"></i></div>
                    <div class="panel-head-text">
                        <div class="panel-head-label">Security</div>
                        <div class="panel-head-title">Change Password</div>
                    </div>
                </div>

                <div class="panel-body">
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="field-group">
                            <label class="field-label" for="current_password">Current Password</label>
                            <div class="field-wrap">
                                <i class="fas fa-lock field-icon"></i>
                                <input type="password"
                                       class="form-control @error('current_password') is-invalid @enderror"
                                       id="current_password" name="current_password"
                                       placeholder="••••••••" required>
                                <i class="fas fa-eye toggle-pass" onclick="togglePw('current_password', this)"></i>
                            </div>
                            @error('current_password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="new_password">New Password</label>
                            <div class="field-wrap">
                                <i class="fas fa-lock field-icon"></i>
                                <input type="password"
                                       class="form-control @error('new_password') is-invalid @enderror"
                                       id="new_password" name="new_password"
                                       placeholder="••••••••" required>
                                <i class="fas fa-eye toggle-pass" onclick="togglePw('new_password', this)"></i>
                            </div>
                            @error('new_password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="new_password_confirmation">Confirm New Password</label>
                            <div class="field-wrap">
                                <i class="fas fa-lock field-icon"></i>
                                <input type="password"
                                       class="form-control"
                                       id="new_password_confirmation"
                                       name="new_password_confirmation"
                                       placeholder="••••••••" required>
                                <i class="fas fa-eye toggle-pass" onclick="togglePw('new_password_confirmation', this)"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn-change-pw">
                            <i class="fas fa-key"></i> Update Password
                        </button>

                    </form>
                </div>

                {{-- ── Danger zone ── --}}
                <div class="danger-zone">
                    <div class="danger-zone-label">Danger Zone</div>
                    <p>Permanently delete your account and all associated data. This action cannot be undone.</p>
                    <button type="button" class="btn-delete" onclick="document.getElementById('deleteModal').classList.add('open')">
                        <i class="fas fa-trash-alt"></i> Delete Account
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- ── DELETE MODAL ── --}}
<div class="modal-backdrop-custom" id="deleteModal">
    <div class="modal-box">
        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-head">
                <span class="modal-head-title">Delete Account</span>
                <button type="button" class="modal-close" onclick="document.getElementById('deleteModal').classList.remove('open')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body-inner">
                <div class="modal-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>This will permanently delete your account, orders, and all personal data. There is no way to recover this information.</p>
                </div>

                <div class="field-group">
                    <label class="field-label" for="delete_password">Enter password to confirm</label>
                    <div class="field-wrap">
                        <i class="fas fa-lock field-icon"></i>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="delete_password" name="password"
                               placeholder="Your current password" required>
                        <i class="fas fa-eye toggle-pass" onclick="togglePw('delete_password', this)"></i>
                    </div>
                    @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="modal-footer-inner">
                <button type="button" class="btn-modal-cancel"
                        onclick="document.getElementById('deleteModal').classList.remove('open')">
                    Cancel
                </button>
                <button type="submit" class="btn-modal-confirm">
                    <i class="fas fa-trash-alt"></i> Delete My Account
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function togglePw(inputId, icon) {
        const input = document.getElementById(inputId);
        const hidden = input.type === 'password';
        input.type = hidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye', !hidden);
        icon.classList.toggle('fa-eye-slash', hidden);
    }

    // Close modal on backdrop click
    document.getElementById('deleteModal').addEventListener('click', function (e) {
        if (e.target === this) this.classList.remove('open');
    });

    // Scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.05 });

    document.querySelectorAll('.anim').forEach(el => observer.observe(el));
</script>
@endpush