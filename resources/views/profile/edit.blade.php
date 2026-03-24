@extends('layouts.app')

@section('title', 'My Profile')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ═══════════════════════════════════════════════════════════════════════════
   TOKENS — consistent with all pages
═══════════════════════════════════════════════════════════════════════════ */
:root {
    --ink:        #0d0d0d;
    --ink-2:      #1c1c1c;
    --ink-3:      #2e2e2e;
    --mist:       #f7f6f3;
    --mist-2:     #efede8;
    --border:     #e3e0d8;
    --border-dk:  #2e2e2e;
    --gold:       #c9a84c;
    --gold-light: #e8c96a;
    --gold-soft:  #f5edd8;
    --white:      #ffffff;
    --text-body:  #4a4742;
    --text-muted: #8c8882;
    --success:    #2d7a5f;
    --success-soft: #e2f0ea;
    --warning:    #d97706;
    --warning-soft: #fef3c7;
    --error:      #c0392b;
    --error-soft: #fbe9e7;

    --f-display: 'Fraunces', Georgia, serif;
    --f-body:    'DM Sans', sans-serif;

    --r-sm: 4px;
    --r-md: 8px;
    --r-lg: 14px;
    --r-xl: 20px;

    --shadow-card: 0 2px 12px rgba(0,0,0,0.06), 0 1px 3px rgba(0,0,0,0.04);
    --shadow-lift: 0 12px 40px rgba(0,0,0,0.12), 0 4px 12px rgba(0,0,0,0.06);
}

*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

body {
    background: var(--mist);
    color: var(--ink);
    font-family: var(--f-body);
    line-height: 1.55;
    -webkit-font-smoothing: antialiased;
}

.wrap {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 40px;
}

/* ═══════════════════════════════════════════════════════════════════════════
   PAGE HEADER
═══════════════════════════════════════════════════════════════════════════ */
.profile-header {
    background: var(--ink);
    padding: 64px 0 56px;
    position: relative;
    overflow: hidden;
}

.profile-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

.profile-header::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--gold), transparent);
}

.header-inner {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 24px;
    flex-wrap: wrap;
    position: relative;
    z-index: 1;
}

.header-left {
    flex: 1;
}

.header-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 20px;
}

.header-eyebrow::before {
    content: '';
    display: block;
    width: 24px;
    height: 1px;
    background: var(--gold);
}

.profile-header h1 {
    font-family: var(--f-display);
    font-size: clamp(48px, 6vw, 72px);
    font-weight: 600;
    line-height: 1.0;
    letter-spacing: -0.03em;
    color: var(--white);
}

.profile-header h1 em {
    font-style: italic;
    font-weight: 300;
    color: var(--gold);
}

.header-sub {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 16px;
    color: rgba(255,255,255,0.55);
    font-size: 14px;
    flex-wrap: wrap;
}

.header-sub i {
    color: var(--gold);
}

/* Logout Button */
.btn-logout {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: transparent;
    color: var(--text-muted);
    font-weight: 500;
    font-size: 14px;
    padding: 12px 24px;
    border-radius: var(--r-md);
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.15);
    transition: all 0.2s;
    cursor: pointer;
}

.btn-logout:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: rgba(201,168,76,0.1);
}

/* ═══════════════════════════════════════════════════════════════════════════
   ALERT
═══════════════════════════════════════════════════════════════════════════ */
.alert {
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    padding: 16px 24px;
    margin: 32px 0 24px;
    box-shadow: var(--shadow-card);
    border-left: 3px solid var(--success);
}

.alert i {
    font-size: 20px;
    color: var(--success);
}

.alert-content {
    flex: 1;
    font-size: 14px;
    font-weight: 500;
    color: var(--ink);
}

/* ═══════════════════════════════════════════════════════════════════════════
   PROFILE IMAGE SECTION
═══════════════════════════════════════════════════════════════════════════ */
.profile-image-section {
    margin: 32px 0 40px;
}

.profile-image-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    padding: 32px;
    display: flex;
    align-items: center;
    gap: 32px;
    flex-wrap: wrap;
    box-shadow: var(--shadow-card);
}

.image-wrapper {
    position: relative;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid var(--white);
    box-shadow: var(--shadow-lift);
    flex-shrink: 0;
    cursor: pointer;
    background: var(--gold-soft);
}

.profile-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.initials {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--f-display);
    font-size: 48px;
    font-weight: 600;
    color: var(--gold);
    background: var(--gold-soft);
}

.image-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.25s ease;
    cursor: pointer;
}

.image-wrapper:hover .image-overlay {
    opacity: 1;
}

.image-overlay i {
    color: white;
    font-size: 28px;
}

.image-info {
    flex: 1;
}

.image-title {
    font-family: var(--f-display);
    font-size: 20px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 8px;
    letter-spacing: -0.02em;
}

.image-text {
    color: var(--text-muted);
    font-size: 14px;
    margin-bottom: 20px;
    line-height: 1.6;
}

.image-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-upload {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--gold);
    color: var(--ink);
    font-weight: 600;
    font-size: 13px;
    padding: 10px 20px;
    border-radius: var(--r-md);
    border: none;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-upload:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(201,168,76,0.25);
}

.btn-remove {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    color: var(--error);
    font-weight: 500;
    font-size: 13px;
    padding: 10px 20px;
    border-radius: var(--r-md);
    border: 1px solid var(--error);
    cursor: pointer;
    transition: all 0.2s;
}

.btn-remove:hover {
    background: var(--error-soft);
    transform: translateY(-2px);
}

.btn-remove:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* ═══════════════════════════════════════════════════════════════════════════
   PROFILE GRID
═══════════════════════════════════════════════════════════════════════════ */
.profile-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
    margin: 0 0 80px;
    align-items: start;
}

/* Cards */
.profile-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow-card);
}

.card-header {
    padding: 24px 28px;
    background: var(--mist-2);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 16px;
}

.card-icon {
    width: 52px;
    height: 52px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 22px;
    flex-shrink: 0;
}

.card-title h3 {
    font-family: var(--f-display);
    font-size: 18px;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
    letter-spacing: -0.02em;
}

.card-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 4px;
    display: block;
}

.card-body {
    padding: 28px;
}

/* Form Styles */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 8px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 12px;
    font-weight: 500;
    color: var(--text-muted);
    margin-bottom: 8px;
}

.optional-badge {
    font-size: 10px;
    color: var(--text-muted);
    background: var(--mist);
    border: 1px solid var(--border);
    padding: 2px 8px;
    border-radius: 100px;
}

.input-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 16px;
    pointer-events: none;
    transition: color 0.2s;
}

.form-control {
    width: 100%;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    color: var(--ink);
    font-family: var(--f-body);
    font-size: 14px;
    padding: 12px 16px 12px 44px;
    outline: none;
    transition: all 0.2s;
}

.form-control:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
}

.input-wrapper:focus-within .input-icon {
    color: var(--gold);
}

.form-control.is-invalid {
    border-color: var(--error);
}

.invalid-feedback {
    font-size: 12px;
    color: var(--error);
    margin-top: 6px;
    display: block;
}

/* Password Toggle */
.password-toggle {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    cursor: pointer;
    font-size: 18px;
    transition: color 0.2s;
}

.password-toggle:hover {
    color: var(--gold);
}

/* Buttons */
.btn-save {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: var(--gold);
    color: var(--ink);
    font-weight: 600;
    font-size: 14px;
    padding: 14px 28px;
    border-radius: var(--r-md);
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    width: 100%;
    margin-top: 12px;
}

.btn-save:hover {
    background: var(--gold-light);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(201,168,76,0.25);
}

.btn-password {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: var(--white);
    color: var(--text-body);
    font-weight: 600;
    font-size: 14px;
    padding: 14px 28px;
    border-radius: var(--r-md);
    border: 1px solid var(--border);
    cursor: pointer;
    transition: all 0.2s;
    width: 100%;
    margin-top: 12px;
}

.btn-password:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-soft);
    transform: translateY(-2px);
}

/* Danger Zone */
.danger-zone {
    margin-top: 24px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    overflow: hidden;
}

.danger-header {
    padding: 20px 28px;
    background: var(--error-soft);
    border-bottom: 1px solid rgba(192,57,43,0.2);
    display: flex;
    align-items: center;
    gap: 12px;
}

.danger-header i {
    color: var(--error);
    font-size: 20px;
}

.danger-title {
    font-family: var(--f-display);
    font-weight: 600;
    color: var(--error);
    font-size: 16px;
}

.danger-body {
    padding: 28px;
}

.danger-text {
    color: var(--text-muted);
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.btn-delete {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: transparent;
    color: var(--error);
    border: 1px solid var(--error);
    border-radius: var(--r-md);
    padding: 12px 24px;
    font-weight: 500;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-delete:hover {
    background: var(--error-soft);
    transform: translateY(-2px);
}

/* ═══════════════════════════════════════════════════════════════════════════
   MODALS
═══════════════════════════════════════════════════════════════════════════ */
.modal-backdrop {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}

.modal-backdrop.open {
    display: flex;
}

.modal-box {
    background: var(--white);
    border-radius: var(--r-xl);
    width: 100%;
    max-width: 480px;
    margin: 20px;
    box-shadow: var(--shadow-lift);
    animation: modalFadeIn 0.3s ease;
}

.modal-box.large {
    max-width: 600px;
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
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.modal-header.error {
    background: var(--error-soft);
}

.modal-header.warning {
    background: var(--warning-soft);
}

.modal-header.success {
    background: var(--success-soft);
}

.modal-title {
    font-family: var(--f-display);
    font-size: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-title.error { color: var(--error); }
.modal-title.warning { color: var(--warning); }
.modal-title.success { color: var(--success); }

.modal-close {
    background: none;
    border: none;
    color: var(--text-muted);
    font-size: 20px;
    cursor: pointer;
    padding: 4px;
    transition: color 0.2s;
}

.modal-close:hover {
    color: var(--ink);
}

.modal-body {
    padding: 28px;
}

.modal-warning {
    display: flex;
    gap: 16px;
    padding: 16px;
    background: var(--error-soft);
    border-radius: var(--r-lg);
    margin-bottom: 24px;
}

.modal-warning i {
    color: var(--error);
    font-size: 20px;
    flex-shrink: 0;
}

.modal-warning p {
    color: var(--text-body);
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
    border-radius: var(--r-md);
    color: var(--text-muted);
    font-weight: 500;
    font-size: 13px;
    padding: 10px 20px;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-modal-cancel:hover {
    border-color: var(--text-muted);
    color: var(--ink);
}

.btn-modal-confirm {
    background: var(--error);
    border: none;
    border-radius: var(--r-md);
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
    background: #a83224;
    transform: translateY(-2px);
}

.btn-modal-confirm.gold {
    background: var(--gold);
    color: var(--ink);
}

.btn-modal-confirm.gold:hover {
    background: var(--gold-light);
}

/* Preview Image */
.preview-image {
    width: 100%;
    max-height: 400px;
    object-fit: contain;
    border-radius: var(--r-lg);
    background: var(--mist);
}

/* Toast Notification */
.toast-notification {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--r-md);
    padding: 16px 20px;
    box-shadow: var(--shadow-lift);
    display: flex;
    align-items: center;
    gap: 12px;
    transform: translateX(400px);
    transition: transform 0.3s ease;
    z-index: 1001;
    max-width: 380px;
}

.toast-notification.show {
    transform: translateX(0);
}

.toast-success { border-left: 4px solid var(--success); }
.toast-error { border-left: 4px solid var(--error); }

.toast-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.toast-success .toast-icon { background: var(--success-soft); color: var(--success); }
.toast-error .toast-icon { background: var(--error-soft); color: var(--error); }

.toast-content {
    flex: 1;
}

.toast-title {
    font-weight: 600;
    color: var(--ink);
    font-size: 14px;
    margin-bottom: 2px;
}

.toast-message {
    color: var(--text-muted);
    font-size: 12px;
}

/* Spinner */
.spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Animations */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(24px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.anim-fade {
    opacity: 0;
    animation: fadeUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

/* Responsive */
@media (max-width: 1024px) {
    .profile-grid {
        grid-template-columns: 1fr;
        gap: 28px;
    }
}

@media (max-width: 768px) {
    .wrap {
        padding: 0 20px;
    }
    
    .profile-header {
        padding: 48px 0 40px;
    }
    
    .profile-header h1 {
        font-size: 40px;
    }
    
    .profile-image-card {
        flex-direction: column;
        text-align: center;
        padding: 28px;
    }
    
    .image-wrapper {
        margin: 0 auto;
    }
    
    .image-actions {
        justify-content: center;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .card-header {
        padding: 20px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .danger-body {
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
    
    .toast-notification {
        left: 20px;
        right: 20px;
        bottom: 20px;
        transform: translateY(400px);
        max-width: none;
    }
    
    .toast-notification.show {
        transform: translateY(0);
    }
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════════
     HEADER SECTION
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="profile-header">
    <div class="wrap">
        <div class="header-inner">
            <div class="header-left">
                <div class="header-eyebrow">Account Settings</div>
                <h1>My <em>Profile</em></h1>
                <div class="header-sub">
                    <i class="bi bi-person-circle"></i>
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    <i class="bi bi-dot"></i>
                    <i class="bi bi-envelope"></i>
                    {{ auth()->user()->email }}
                </div>
            </div>
            
            <button type="button" class="btn-logout" onclick="openLogoutModal()">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </button>
        </div>
    </div>
</div>

<div class="wrap">
    
    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert anim-fade">
            <i class="bi bi-check-circle-fill"></i>
            <span class="alert-content">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Profile Image Section --}}
    <div class="profile-image-section anim-fade">
        <div class="profile-image-card">
            <div class="image-wrapper" onclick="document.getElementById('profile-photo-input').click()">
                @php
                    $user = auth()->user();
                    $initials = strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1));
                    $profilePhoto = $user->profile_photo;
                    $fileExists = $profilePhoto && Storage::disk('public')->exists($profilePhoto);
                @endphp
                
                @if($profilePhoto && $fileExists)
                    <img src="{{ asset('storage/' . $profilePhoto) }}?t={{ time() }}" alt="Profile" class="profile-image">
                @else
                    <div class="initials">{{ $initials }}</div>
                @endif
                
                <div class="image-overlay">
                    <i class="bi bi-camera-fill"></i>
                </div>
            </div>
            
            <div class="image-info">
                <h3 class="image-title">Profile Photo</h3>
                <p class="image-text">
                    Upload a profile photo to personalize your account. 
                    Supported formats: JPG, PNG. Max size: 2MB.
                </p>
                <div class="image-actions">
                    <button type="button" class="btn-upload" onclick="document.getElementById('profile-photo-input').click()">
                        <i class="bi bi-cloud-upload"></i>
                        Upload Photo
                    </button>
                    
                    @if($profilePhoto && $fileExists)
                        <button type="button" class="btn-remove" onclick="confirmRemovePhoto()">
                            <i class="bi bi-trash3"></i>
                            Remove
                        </button>
                    @endif
                </div>
                <input type="file" id="profile-photo-input" accept="image/*" style="display: none;">
            </div>
        </div>
    </div>

    {{-- Profile Grid --}}
    <div class="profile-grid">
        
        {{-- Left Column - Profile Information --}}
        <div class="profile-card anim-fade" style="animation-delay: 0.08s">
            <div class="card-header">
                <div class="card-icon">
                    <i class="bi bi-person"></i>
                </div>
                <div class="card-title">
                    <span class="card-label">Edit Details</span>
                    <h3>Profile Information</h3>
                </div>
            </div>

            <div class="card-body">
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
                                       value="{{ old('first_name', $user->first_name) }}"
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
                                       value="{{ old('last_name', $user->last_name) }}"
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
                            <span class="optional-badge">Optional</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text"
                                   class="form-control @error('middle_name') is-invalid @enderror"
                                   id="middle_name" name="middle_name"
                                   value="{{ old('middle_name', $user->middle_name) }}"
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
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="john@example.com" required>
                        </div>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="contact_no">
                            Contact Number
                            <span class="optional-badge">Optional</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="bi bi-phone input-icon"></i>
                            <input type="text"
                                   class="form-control @error('contact_no') is-invalid @enderror"
                                   id="contact_no" name="contact_no"
                                   value="{{ old('contact_no', $user->contact_no) }}"
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
        <div class="profile-card anim-fade" style="animation-delay: 0.15s">
            <div class="card-header">
                <div class="card-icon">
                    <i class="bi bi-key"></i>
                </div>
                <div class="card-title">
                    <span class="card-label">Security</span>
                    <h3>Change Password</h3>
                </div>
            </div>

            <div class="card-body">
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
                <div class="danger-header">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span class="danger-title">Danger Zone</span>
                </div>
                <div class="danger-body">
                    <p class="danger-text">
                        Permanently delete your account and all associated data including orders and tickets. 
                        This action cannot be undone.
                    </p>
                    <button type="button" class="btn-delete" onclick="openDeleteModal()">
                        <i class="bi bi-trash3"></i>
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Account Modal --}}
<div class="modal-backdrop" id="deleteModal">
    <div class="modal-box">
        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            
            <div class="modal-header error">
                <span class="modal-title error">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Delete Account
                </span>
                <button type="button" class="modal-close" onclick="closeDeleteModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="modal-warning">
                    <i class="bi bi-exclamation-circle-fill"></i>
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
                <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">
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

{{-- Logout Confirmation Modal --}}
<div class="modal-backdrop" id="logoutModal">
    <div class="modal-box">
        <div class="modal-header warning">
            <span class="modal-title warning">
                <i class="bi bi-box-arrow-right"></i>
                Confirm Logout
            </span>
            <button type="button" class="modal-close" onclick="closeLogoutModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="modal-warning" style="background: var(--warning-soft);">
                <i class="bi bi-info-circle-fill" style="color: var(--warning);"></i>
                <p style="color: var(--text-body);">
                    Are you sure you want to logout? You'll need to login again to access your account.
                </p>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn-modal-cancel" onclick="closeLogoutModal()">
                Cancel
            </button>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-modal-confirm gold">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Image Preview Modal --}}
<div class="modal-backdrop" id="previewModal">
    <div class="modal-box large">
        <div class="modal-header success">
            <span class="modal-title success">
                <i class="bi bi-image"></i>
                Preview Image
            </span>
            <button type="button" class="modal-close" onclick="closePreviewModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body" style="text-align: center;">
            <img id="preview-image" src="" alt="Preview" class="preview-image">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-modal-cancel" onclick="closePreviewModal()">
                Cancel
            </button>
            <button type="button" class="btn-modal-confirm gold" onclick="uploadProfilePhoto()">
                <i class="bi bi-check-lg"></i>
                Use This Photo
            </button>
        </div>
    </div>
</div>

{{-- Toast Notification --}}
<div id="toast-notification" class="toast-notification">
    <div class="toast-icon">
        <i class="bi bi-check-lg"></i>
    </div>
    <div class="toast-content">
        <div class="toast-title" id="toast-title">Success</div>
        <div class="toast-message" id="toast-message">Profile photo updated successfully</div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let selectedFile = null;

// Toggle password visibility
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);
    if (!input) return;
    
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);
    
    if (type === 'password') {
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
}

// Modal controls
function openDeleteModal() {
    document.getElementById('deleteModal').classList.add('open');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('open');
}

function openLogoutModal() {
    document.getElementById('logoutModal').classList.add('open');
}

function closeLogoutModal() {
    document.getElementById('logoutModal').classList.remove('open');
}

function closePreviewModal() {
    document.getElementById('previewModal').classList.remove('open');
    const input = document.getElementById('profile-photo-input');
    if (input) input.value = '';
    selectedFile = null;
}

// Toast notification
function showToast(type, title, message) {
    const toast = document.getElementById('toast-notification');
    if (!toast) return;
    
    toast.classList.remove('toast-success', 'toast-error', 'show');
    
    if (type === 'success') {
        toast.classList.add('toast-success');
        toast.querySelector('.toast-icon').innerHTML = '<i class="bi bi-check-lg"></i>';
    } else if (type === 'error') {
        toast.classList.add('toast-error');
        toast.querySelector('.toast-icon').innerHTML = '<i class="bi bi-exclamation-lg"></i>';
    }
    
    document.getElementById('toast-title').textContent = title;
    document.getElementById('toast-message').textContent = message;
    
    toast.classList.add('show');
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Profile photo upload
document.addEventListener('DOMContentLoaded', function() {
    const photoInput = document.getElementById('profile-photo-input');
    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                showToast('error', 'Invalid File', 'Please select a JPG or PNG image.');
                this.value = '';
                return;
            }
            
            const maxSize = 2 * 1024 * 1024;
            if (file.size > maxSize) {
                showToast('error', 'File Too Large', 'Maximum file size is 2MB.');
                this.value = '';
                return;
            }
            
            selectedFile = file;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('previewModal').classList.add('open');
            };
            reader.readAsDataURL(file);
        });
    }
});

function uploadProfilePhoto() {
    if (!selectedFile) {
        showToast('error', 'No File', 'Please select an image first.');
        return;
    }
    
    const formData = new FormData();
    formData.append('profile_photo', selectedFile);
    formData.append('_token', '{{ csrf_token() }}');
    
    const submitBtn = document.querySelector('#previewModal .btn-modal-confirm');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Uploading...';
    submitBtn.disabled = true;
    
    fetch('{{ route("profile.photo.update") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('success', 'Success!', 'Profile photo updated successfully');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast('error', 'Error!', data.message || 'Failed to update profile photo');
        }
    })
    .catch(error => {
        showToast('error', 'Upload Failed', 'An error occurred while uploading');
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        closePreviewModal();
        selectedFile = null;
    });
}

function confirmRemovePhoto() {
    if (confirm('Are you sure you want to remove your profile photo?')) {
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'DELETE');
        
        const removeBtn = document.querySelector('.btn-remove');
        const originalText = removeBtn.innerHTML;
        removeBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Removing...';
        removeBtn.disabled = true;
        
        fetch('{{ route("profile.photo.remove") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('success', 'Success!', 'Profile photo removed successfully');
                setTimeout(() => location.reload(), 1500);
            } else {
                showToast('error', 'Error!', data.message || 'Failed to remove profile photo');
                removeBtn.innerHTML = originalText;
                removeBtn.disabled = false;
            }
        })
        .catch(error => {
            showToast('error', 'Error!', 'An error occurred while removing photo');
            removeBtn.innerHTML = originalText;
            removeBtn.disabled = false;
        });
    }
}

// Close modals when clicking backdrop
document.addEventListener('DOMContentLoaded', function() {
    const modals = ['deleteModal', 'logoutModal', 'previewModal'];
    modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('open');
                }
            });
        }
    });
    
    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.05, rootMargin: '0px 0px -30px 0px' });
    
    document.querySelectorAll('.anim-fade').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
    
    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.transition = 'opacity 0.4s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 400);
        });
    }, 5000);
});
</script>
@endpush