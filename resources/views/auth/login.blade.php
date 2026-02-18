@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .login-page {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        padding: 40px 0;
    }

    .login-wrapper {
        position: relative;
        width: 100%;
    }

    .login-card {
        border: none;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.8s ease;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }

    .login-header {
        background: var(--primary-gradient);
        padding: 40px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .login-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,170.7C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-repeat: no-repeat;
        background-position: bottom;
        background-size: cover;
        opacity: 0.3;
    }

    .login-header-content {
        position: relative;
        z-index: 2;
    }

    .login-header h1 {
        color: white;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .login-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        margin: 0;
    }

    .login-body {
        padding: 40px;
        background: white;
    }

    .welcome-back {
        text-align: center;
        margin-bottom: 30px;
    }

    .welcome-back h3 {
        color: #333;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .welcome-back p {
        color: #666;
    }

    .social-login {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-bottom: 30px;
    }

    .social-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        color: #666;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        text-decoration: none;
        border: 1px solid #e0e0e0;
    }

    .social-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .social-btn.google:hover {
        background: #DB4437;
        color: white;
        border-color: #DB4437;
    }

    .social-btn.facebook:hover {
        background: #4267B2;
        color: white;
        border-color: #4267B2;
    }

    .social-btn.twitter:hover {
        background: #1DA1F2;
        color: white;
        border-color: #1DA1F2;
    }

    .divider {
        position: relative;
        text-align: center;
        margin: 30px 0;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, #e0e0e0, transparent);
    }

    .divider span {
        background: white;
        padding: 0 20px;
        color: #666;
        font-size: 0.9rem;
        position: relative;
        z-index: 2;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #667eea;
        font-size: 1.1rem;
        z-index: 2;
    }

    .form-control {
        height: 55px;
        padding: 10px 15px 10px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .form-control.is-invalid {
        border-color: #f5576c;
        background-image: none;
    }

    .invalid-feedback {
        color: #f5576c;
        font-size: 0.85rem;
        margin-top: 5px;
        padding-left: 15px;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        cursor: pointer;
        z-index: 3;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #667eea;
    }

    .remember-me label {
        color: #666;
        font-size: 0.95rem;
        cursor: pointer;
        margin: 0;
    }

    .forgot-password {
        color: #667eea;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .btn-login {
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 15px;
        padding: 15px 30px;
        font-weight: 600;
        font-size: 1.1rem;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-login:hover::before {
        left: 100%;
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .register-link {
        text-align: center;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid #e0e0e0;
    }

    .register-link p {
        color: #666;
        margin-bottom: 0;
    }

    .register-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
        position: relative;
    }

    .register-link a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-gradient);
        transition: width 0.3s ease;
    }

    .register-link a:hover {
        color: #764ba2;
    }

    .register-link a:hover::after {
        width: 100%;
    }

    .floating-shape {
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: var(--primary-gradient);
        opacity: 0.1;
        z-index: -1;
    }

    .shape-1 {
        top: -100px;
        left: -100px;
        animation: float 8s infinite ease-in-out;
    }

    .shape-2 {
        bottom: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: var(--secondary-gradient);
        animation: float 10s infinite ease-in-out reverse;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(5deg);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-body {
            padding: 30px 20px;
        }

        .login-header {
            padding: 30px 20px;
        }

        .login-header h1 {
            font-size: 2rem;
        }

        .form-options {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }
    }

    /* Loading state */
    .btn-login.loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-login.loading .btn-text {
        display: none;
    }

    .btn-login.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid rgba(255,255,255,0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s infinite linear;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
@endpush

@section('content')
<div class="login-page">
    <div class="container login-wrapper">
        <!-- Floating Background Shapes -->
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-card">
                    <!-- Header -->
                    <div class="login-header">
                        <div class="login-header-content">
                            <h1>Welcome Back! 👋</h1>
                            <p>Sign in to continue your journey</p>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="login-body">
                        <div class="welcome-back">
                            <h3>Login to Your Account</h3>
                            <p>Choose your preferred login method</p>
                        </div>

                        <!-- Social Login -->
                        <div class="social-login">
                            <a href="#" class="social-btn google" title="Login with Google">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="social-btn facebook" title="Login with Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-btn twitter" title="Login with Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>

                        <!-- Divider -->
                        <div class="divider">
                            <span>OR CONTINUE WITH EMAIL</span>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Enter your email"
                                           required 
                                           autofocus>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Enter your password"
                                           required>
                                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Options -->
                            <div class="form-options">
                                <div class="remember-me">
                                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="forgot-password">
                                    Forgot Password?
                                </a>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-login" id="submitBtn">
                                <span class="btn-text">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </span>
                            </button>
                        </form>

                        <!-- Register Link -->
                        <div class="register-link">
                            <p>
                                Don't have an account? 
                                <a href="{{ route('register') }}">
                                    Create Account <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="text-center mt-4">
                    <p class="text-muted small">
                        By signing in, you agree to our 
                        <a href="#" class="text-decoration-none">Terms of Service</a> and 
                        <a href="#" class="text-decoration-none">Privacy Policy</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Password visibility toggle
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // Form submission loading state
    const loginForm = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');

    loginForm.addEventListener('submit', function() {
        submitBtn.classList.add('loading');
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);

    // Add floating label effect
    const formControls = document.querySelectorAll('.form-control');
    formControls.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('i:first-child').style.color = '#667eea';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.querySelector('i:first-child').style.color = '#667eea';
        });
    });

    // Smooth scroll to top on validation errors
    @if($errors->any())
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    @endif
</script>
@endpush