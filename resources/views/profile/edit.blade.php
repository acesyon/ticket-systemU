@extends('layouts.app')

@section('title', 'My Profile')

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
        --success-soft: #e6f7e6;
        --warning: #f59e0b;
        --warning-soft: #fef3c7;
        --error: #ef4444;
        --error-soft: #fee9e7;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.02), 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.02), 0 4px 6px -2px rgba(0,0,0,0.01);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--off-white);
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        line-height: 1.5;
        -webkit-font-smoothing: antialiased;
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

    /* Page Header */
    .profile-header {
        padding: 60px 0 32px;
        background: linear-gradient(to bottom, var(--white), var(--off-white));
        border-bottom: 1px solid var(--border);
    }

    .profile-header-eyebrow {
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--accent);
        background: var(--accent-soft);
        padding: 6px 14px;
        border-radius: 100px;
        margin-bottom: 20px;
    }

    .profile-header h1 {
        font-size: clamp(36px, 4vw, 48px);
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .profile-header h1 em {
        font-style: normal;
        color: var(--accent);
    }

    .profile-header-sub {
        font-size: 16px;
        color: var(--text-secondary);
        font-weight: 400;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .profile-header-sub i {
        color: var(--accent);
        font-size: 16px;
    }

    /* Profile Layout */
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin: 40px 0 60px;
        align-items: start;
    }

    /* Cards */
    .profile-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .profile-card:hover {
        box-shadow: var(--shadow-md);
    }

    .profile-card-header {
        padding: 24px 28px;
        background: var(--off-white);
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .profile-card-icon {
        width: 48px;
        height: 48px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 20px;
        flex-shrink: 0;
        box-shadow: var(--shadow-sm);
    }

    .profile-card-icon.warning {
        color: var(--warning);
    }

    .profile-card-icon.error {
        color: var(--error);
    }

    .profile-card-title {
        flex: 1;
    }

    .profile-card-label {
        font-size: 12px;
        font-weight: 500;
        color: var(--text-tertiary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 4px;
        display: block;
    }

    .profile-card-heading {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .profile-card-body {
        padding: 28px;
    }

    /* Form Fields */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-secondary);
        margin-bottom: 8px;
    }

    .optional-tag {
        font-size: 11px;
        color: var(--text-tertiary);
        background: var(--off-white);
        border: 1px solid var(--border);
        padding: 2px 8px;
        border-radius: 100px;
        letter-spacing: 0.02em;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        font-size: 16px;
        pointer-events: none;
        transition: color 0.2s;
    }

    .form-control {
        width: 100%;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-primary);
        font-family: 'Inter', sans-serif;
        font-size: 15px;
        padding: 14px 16px 14px 46px;
        outline: none;
        transition: all 0.2s;
    }

    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-soft);
    }

    .input-wrapper:focus-within .input-icon {
        color: var(--accent);
    }

    .form-control::placeholder {
        color: var(--text-tertiary);
        font-size: 14px;
    }

    .form-control.is-invalid {
        border-color: var(--error);
        box-shadow: 0 0 0 3px var(--error-soft);
    }

    /* Password Toggle */
    .password-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-tertiary);
        cursor: pointer;
        font-size: 18px;
        z-index: 2;
        transition: color 0.2s;
    }

    .password-toggle:hover {
        color: var(--accent);
    }

    /* Error Feedback */
    .invalid-feedback {
        font-size: 12px;
        color: var(--error);
        margin-top: 6px;
        display: block;
    }

    /* Buttons */
    .btn-save {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: var(--radius-sm);
        padding: 14px 32px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
        margin-top: 8px;
    }

    .btn-save:hover {
        background: var(--accent-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-save i {
        transition: transform 0.2s;
    }

    .btn-save:hover i {
        transform: translateX(4px);
    }

    .btn-password {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--white);
        color: var(--text-secondary);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 14px 32px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
        margin-top: 8px;
    }

    .btn-password:hover {
        border-color: var(--warning);
        color: var(--warning);
        background: var(--warning-soft);
        transform: translateY(-1px);
    }

    .btn-password i {
        transition: transform 0.2s;
    }

    .btn-password:hover i {
        transform: translateY(-2px);
    }

    /* Danger Zone */
    .danger-zone {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        margin-top: 24px;
    }

    .danger-zone-header {
        padding: 20px 28px;
        background: var(--error-soft);
        border-bottom: 1px solid rgba(239, 68, 68, 0.2);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .danger-zone-header i {
        color: var(--error);
        font-size: 20px;
    }

    .danger-zone-title {
        font-weight: 600;
        color: var(--error);
        font-size: 16px;
    }

    .danger-zone-body {
        padding: 28px;
    }

    .danger-zone-text {
        color: var(--text-secondary);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--white);
        color: var(--error);
        border: 1px solid var(--error);
        border-radius: var(--radius-sm);
        padding: 12px 24px;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-delete:hover {
        background: var(--error-soft);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    /* Modal */
    .modal-backdrop-custom {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
    }

    .modal-backdrop-custom.open {
        display: flex;
    }

    .modal-box {
        background: var(--white);
        border-radius: var(--radius-lg);
        width: 100%;
        max-width: 480px;
        margin: 20px;
        box-shadow: var(--shadow-lg);
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        padding: 24px 28px;
        background: var(--error-soft);
        border-bottom: 1px solid rgba(239, 68, 68, 0.2);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--error);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-close {
        background: none;
        border: none;
        color: var(--text-tertiary);
        font-size: 20px;
        cursor: pointer;
        transition: color 0.2s;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .modal-close:hover {
        color: var(--error);
        background: rgba(239, 68, 68, 0.1);
    }

    .modal-body {
        padding: 28px;
    }

    .modal-warning {
        display: flex;
        gap: 16px;
        padding: 16px;
        background: var(--error-soft);
        border-radius: var(--radius-md);
        margin-bottom: 24px;
    }

    .modal-warning i {
        color: var(--error);
        font-size: 20px;
        flex-shrink: 0;
    }

    .modal-warning p {
        color: var(--text-secondary);
        font-size: 14px;
        line-height: 1.6;
        margin: 0;
    }

    .modal-footer {
        padding: 20px 28px;
        border-top: 1px solid var(--border);
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .btn-modal-cancel {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 13px;
        padding: 10px 20px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-modal-cancel:hover {
        border-color: var(--text-secondary);
        color: var(--text-primary);
    }

    .btn-modal-confirm {
        background: var(--error);
        border: none;
        border-radius: var(--radius-sm);
        color: white;
        font-weight: 500;
        font-size: 13px;
        padding: 10px 24px;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-modal-confirm:hover {
        background: #dc2626;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    /* Animations */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .anim {
        opacity: 0;
        animation: fadeUp 0.6s ease forwards;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .profile-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }
    }

    @media (max-width: 768px) {
        .container-custom {
            padding: 0 20px;
        }

        .profile-header {
            padding: 40px 0 24px;
        }

        .profile-header h1 {
            font-size: 32px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .profile-card-header {
            padding: 20px;
        }

        .profile-card-body {
            padding: 20px;
        }

        .danger-zone-body {
            padding: 20px;
        }

        .modal-footer {
            flex-direction: column;
        }

        .btn-modal-cancel,
        .btn-modal-confirm {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div class="profile-header">
    <div class="container-custom">
        <span class="profile-header-eyebrow">Account Settings</span>
        <h1>My <em class="text-gradient">Profile</em></h1>
        <div class="profile-header-sub">
            <i class="bi bi-person-circle"></i>
            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
            <i class="bi bi-dot"></i>
            <i class="bi bi-envelope"></i>
            {{ auth()->user()->email }}
        </div>
    </div>
</div>

<div class="container-custom">
    <div class="profile-grid">
        {{-- Left Column - Profile Information --}}
        <div class="profile-card anim">
            <div class="profile-card-header">
                <div class="profile-card-icon">
                    <i class="bi bi-person"></i>
                </div>
                <div class="profile-card-title">
                    <span class="profile-card-label">Edit Details</span>
                    <h3 class="profile-card-heading">Profile Information</h3>
                </div>
            </div>

            <div class="profile-card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="first_name">First Name</label>
                            <div class="input-wrapper">
                                <i class="bi bi-person input-icon"></i>
                                <input type="text"
                                       class="form-control @error('first_name') is-invalid @enderror"
                                       id="first_name" name="first_name"
                                       value="{{ old('first_name', auth()->user()->first_name) }}"
                                       placeholder="John" required>
                            </div>
                            @error('first_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="last_name">Last Name</label>
                            <div class="input-wrapper">
                                <i class="bi bi-person input-icon"></i>
                                <input type="text"
                                       class="form-control @error('last_name') is-invalid @enderror"
                                       id="last_name" name="last_name"
                                       value="{{ old('last_name', auth()->user()->last_name) }}"
                                       placeholder="Doe" required>
                            </div>
                            @error('last_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="middle_name">
                            Middle Name
                            <span class="optional-tag">Optional</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text"
                                   class="form-control @error('middle_name') is-invalid @enderror"
                                   id="middle_name" name="middle_name"
                                   value="{{ old('middle_name', auth()->user()->middle_name) }}"
                                   placeholder="Middle name">
                        </div>
                        @error('middle_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   placeholder="john@example.com" required>
                        </div>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="contact_no">
                            Contact Number
                            <span class="optional-tag">Optional</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-phone input-icon"></i>
                            <input type="text"
                                   class="form-control @error('contact_no') is-invalid @enderror"
                                   id="contact_no" name="contact_no"
                                   value="{{ old('contact_no', auth()->user()->contact_no) }}"
                                   placeholder="+63 900 000 0000">
                        </div>
                        @error('contact_no')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-lg"></i>
                        Save Changes
                    </button>
                </form>
            </div>
        </div>

        {{-- Right Column - Password & Danger Zone --}}
        <div class="profile-card anim" style="animation-delay: 0.1s">
            <div class="profile-card-header">
                <div class="profile-card-icon warning">
                    <i class="bi bi-key"></i>
                </div>
                <div class="profile-card-title">
                    <span class="profile-card-label">Security</span>
                    <h3 class="profile-card-heading">Change Password</h3>
                </div>
            </div>

            <div class="profile-card-body">
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label class="form-label" for="current_password">Current Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   id="current_password" name="current_password"
                                   placeholder="••••••••" required>
                            <i class="bi bi-eye password-toggle" onclick="togglePassword('current_password', this)"></i>
                        </div>
                        @error('current_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="new_password">New Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   id="new_password" name="new_password"
                                   placeholder="••••••••" required>
                            <i class="bi bi-eye password-toggle" onclick="togglePassword('new_password', this)"></i>
                        </div>
                        @error('new_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password"
                                   class="form-control"
                                   id="new_password_confirmation"
                                   name="new_password_confirmation"
                                   placeholder="••••••••" required>
                            <i class="bi bi-eye password-toggle" onclick="togglePassword('new_password_confirmation', this)"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-password">
                        <i class="bi bi-arrow-repeat"></i>
                        Update Password
                    </button>
                </form>
            </div>

            {{-- Danger Zone --}}
            <div class="danger-zone">
                <div class="danger-zone-header">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span class="danger-zone-title">Danger Zone</span>
                </div>
                <div class="danger-zone-body">
                    <p class="danger-zone-text">
                        Permanently delete your account and all associated data including orders and tickets. This action cannot be undone.
                    </p>
                    <button type="button" class="btn-delete" onclick="document.getElementById('deleteModal').classList.add('open')">
                        <i class="bi bi-trash3"></i>
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Account Modal --}}
<div class="modal-backdrop-custom" id="deleteModal">
    <div class="modal-box">
        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="modal-header">
                <span class="modal-title">
                    <i class="bi bi-exclamation-triangle"></i>
                    Delete Account
                </span>
                <button type="button" class="modal-close" onclick="document.getElementById('deleteModal').classList.remove('open')">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="modal-warning">
                    <i class="bi bi-exclamation-circle"></i>
                    <p>
                        This will permanently delete your account, all orders, tickets, and personal data. 
                        There is no way to recover this information once deleted.
                    </p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="delete_password">Enter your password to confirm</label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="delete_password" name="password"
                               placeholder="Your current password" required>
                        <i class="bi bi-eye password-toggle" onclick="togglePassword('delete_password', this)"></i>
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" onclick="document.getElementById('deleteModal').classList.remove('open')">
                    Cancel
                </button>
                <button type="submit" class="btn-modal-confirm">
                    <i class="bi bi-trash3"></i>
                    Permanently Delete
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Toggle password visibility
    function togglePassword(inputId, icon) {
        const input = document.getElementById(inputId);
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        
        // Toggle icon
        if (type === 'password') {
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    }

    // Close modal when clicking backdrop
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('open');
        }
    });

    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('anim');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.anim:not(.anim)').forEach(el => observer.observe(el));
</script>
@endpush