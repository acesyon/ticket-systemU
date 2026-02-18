@extends('layouts.app')

@section('title', 'Register')

@push('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .register-page {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        padding: 40px 0;
    }

    .register-wrapper {
        position: relative;
        width: 100%;
    }

    .register-card {
        border: none;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.8s ease;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }

    .register-header {
        background: var(--primary-gradient);
        padding: 40px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .register-header::before {
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

    .register-header-content {
        position: relative;
        z-index: 2;
    }

    .register-header h1 {
        color: white;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .register-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        margin: 0;
    }

    .register-body {
        padding: 40px;
        background: white;
    }

    .welcome-message {
        text-align: center;
        margin-bottom: 30px;
    }

    .welcome-message h3 {
        color: #333;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .welcome-message p {
        color: #666;
    }

    .social-register {
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

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        flex: 1;
        margin-bottom: 20px;
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
        transition: color 0.3s ease;
    }

    .form-control {
        height: 55px;
        padding: 10px 15px 10px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        width: 100%;
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

    .password-strength {
        margin-top: 10px;
        padding: 0 15px;
    }

    .strength-bar {
        display: flex;
        gap: 5px;
        margin-bottom: 5px;
    }

    .strength-segment {
        height: 5px;
        flex: 1;
        background: #e0e0e0;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .strength-segment.active {
        background: var(--primary-gradient);
    }

    .strength-text {
        font-size: 0.85rem;
        color: #666;
    }

    .terms-checkbox {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin: 25px 0;
    }

    .terms-checkbox input[type="checkbox"] {
        width: 20px;
        height: 20px;
        margin-top: 2px;
        cursor: pointer;
        accent-color: #667eea;
    }

    .terms-checkbox label {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.5;
        cursor: pointer;
        flex: 1;
    }

    .terms-checkbox a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        position: relative;
    }

    .terms-checkbox a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-gradient);
        transition: width 0.3s ease;
    }

    .terms-checkbox a:hover::after {
        width: 100%;
    }

    .btn-register {
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

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-register:hover::before {
        left: 100%;
    }

    .btn-register:active {
        transform: translateY(0);
    }

    .login-link {
        text-align: center;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid #e0e0e0;
    }

    .login-link p {
        color: #666;
        margin-bottom: 0;
    }

    .login-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
        position: relative;
    }

    .login-link a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-gradient);
        transition: width 0.3s ease;
    }

    .login-link a:hover {
        color: #764ba2;
    }

    .login-link a:hover::after {
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
        right: -100px;
        animation: float 8s infinite ease-in-out;
    }

    .shape-2 {
        bottom: -100px;
        left: -100px;
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
        .register-body {
            padding: 30px 20px;
        }

        .register-header {
            padding: 30px 20px;
        }

        .register-header h1 {
            font-size: 2rem;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }

    /* Loading state */
    .btn-register.loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-register.loading .btn-text {
        display: none;
    }

    .btn-register.loading::after {
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

    /* Input validation icons */
    .validation-icon {
        position: absolute;
        right: 45px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .validation-icon.valid {
        color: #28a745;
        opacity: 1;
    }

    .validation-icon.invalid {
        color: #dc3545;
        opacity: 1;
    }
</style>
@endpush

@section('content')
<div class="register-page">
    <div class="container register-wrapper">
        <!-- Floating Background Shapes -->
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="register-card">
                    <!-- Header -->
                    <div class="register-header">
                        <div class="register-header-content">
                            <h1>Join Us Today! 🚀</h1>
                            <p>Create your account and start your journey</p>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="register-body">
                        <div class="welcome-message">
                            <h3>Create an Account</h3>
                            <p>Sign up using social media or email</p>
                        </div>

                        <!-- Social Registration -->
                        <div class="social-register">
                            <a href="#" class="social-btn google" title="Sign up with Google">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="social-btn facebook" title="Sign up with Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-btn twitter" title="Sign up with Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>

                        <!-- Divider -->
                        <div class="divider">
                            <span>OR SIGN UP WITH EMAIL</span>
                        </div>

                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf

                            <!-- Name Row -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" 
                                               class="form-control @error('first_name') is-invalid @enderror" 
                                               id="first_name" 
                                               name="first_name" 
                                               value="{{ old('first_name') }}" 
                                               placeholder="Enter first name"
                                               required>
                                    </div>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" 
                                               class="form-control @error('last_name') is-invalid @enderror" 
                                               id="last_name" 
                                               name="last_name" 
                                               value="{{ old('last_name') }}" 
                                               placeholder="Enter last name"
                                               required>
                                    </div>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

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
                                           required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contact Number -->
                            <div class="form-group">
                                <label for="contact_no">Contact Number <span class="text-muted">(Optional)</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-phone-alt"></i>
                                    <input type="text" 
                                           class="form-control @error('contact_no') is-invalid @enderror" 
                                           id="contact_no" 
                                           name="contact_no" 
                                           value="{{ old('contact_no') }}" 
                                           placeholder="Enter contact number">
                                </div>
                                @error('contact_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Row -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Create password"
                                               required>
                                        <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Password Strength Indicator -->
                                    <div class="password-strength">
                                        <div class="strength-bar">
                                            <div class="strength-segment" id="strength1"></div>
                                            <div class="strength-segment" id="strength2"></div>
                                            <div class="strength-segment" id="strength3"></div>
                                            <div class="strength-segment" id="strength4"></div>
                                        </div>
                                        <span class="strength-text" id="strengthText">Enter password</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" 
                                               class="form-control" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               placeholder="Confirm password"
                                               required>
                                        <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="terms-checkbox">
                                <input type="checkbox" id="terms" name="terms" required>
                                <label for="terms">
                                    I agree to the <a href="#">Terms of Service</a> and 
                                    <a href="#">Privacy Policy</a>. I confirm that I am at least 16 years old.
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-register" id="submitBtn">
                                <span class="btn-text">
                                    <i class="fas fa-user-plus me-2"></i>Create Account
                                </span>
                            </button>
                        </form>

                        <!-- Login Link -->
                        <div class="login-link">
                            <p>
                                Already have an account? 
                                <a href="{{ route('login') }}">
                                    Sign In <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="text-center mt-4">
                    <p class="text-muted small">
                        By creating an account, you agree to receive event notifications and updates.
                        You can unsubscribe at any time.
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
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPassword = document.getElementById('password_confirmation');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // Password strength checker
    const strengthSegments = {
        1: document.getElementById('strength1'),
        2: document.getElementById('strength2'),
        3: document.getElementById('strength3'),
        4: document.getElementById('strength4')
    };
    const strengthText = document.getElementById('strengthText');

    password.addEventListener('input', function() {
        const value = this.value;
        let strength = 0;
        
        // Reset segments
        for (let i = 1; i <= 4; i++) {
            strengthSegments[i].classList.remove('active');
        }
        
        if (value.length > 0) {
            // Check length
            if (value.length >= 8) strength++;
            
            // Check for numbers
            if (/\d/.test(value)) strength++;
            
            // Check for lowercase and uppercase
            if (/[a-z]/.test(value) && /[A-Z]/.test(value)) strength++;
            
            // Check for special characters
            if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) strength++;
            
            // Update segments
            for (let i = 1; i <= strength; i++) {
                strengthSegments[i].classList.add('active');
            }
            
            // Update text
            const strengthLabels = ['Very Weak', 'Weak', 'Medium', 'Strong', 'Very Strong'];
            strengthText.textContent = strengthLabels[strength];
            strengthText.style.color = ['#dc3545', '#ffc107', '#17a2b8', '#28a745', '#28a745'][strength];
        } else {
            strengthText.textContent = 'Enter password';
            strengthText.style.color = '#666';
        }
    });

    // Password match checker
    confirmPassword.addEventListener('input', function() {
        if (password.value && this.value) {
            if (password.value === this.value) {
                this.style.borderColor = '#28a745';
                this.style.boxShadow = '0 0 0 4px rgba(40, 167, 69, 0.1)';
            } else {
                this.style.borderColor = '#dc3545';
                this.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
            }
        } else {
            this.style.borderColor = '#e0e0e0';
            this.style.boxShadow = 'none';
        }
    });

    // Form submission loading state
    const registerForm = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');

    registerForm.addEventListener('submit', function(e) {
        const terms = document.getElementById('terms');
        if (!terms.checked) {
            e.preventDefault();
            alert('Please agree to the Terms of Service and Privacy Policy');
            return;
        }
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

    // Input focus effects
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

    // Real-time email validation
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', function() {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value.length > 0) {
            if (emailPattern.test(this.value)) {
                this.style.borderColor = '#28a745';
                this.style.boxShadow = '0 0 0 4px rgba(40, 167, 69, 0.1)';
            } else {
                this.style.borderColor = '#dc3545';
                this.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
            }
        } else {
            this.style.borderColor = '#e0e0e0';
            this.style.boxShadow = 'none';
        }
    });

    // Phone number formatting (optional)
    const contactInput = document.getElementById('contact_no');
    contactInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 0) {
            if (value.length <= 11) {
                this.style.borderColor = '#28a745';
                this.style.boxShadow = '0 0 0 4px rgba(40, 167, 69, 0.1)';
            } else {
                this.style.borderColor = '#dc3545';
                this.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
            }
        } else {
            this.style.borderColor = '#e0e0e0';
            this.style.boxShadow = 'none';
        }
    });
</script>
@endpush