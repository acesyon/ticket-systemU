<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TicketPro</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --paper: #faf7f2;
            --ink: #1e1e24;
            --muted: #5b5b66;
            --accent: #b0654d;
            --accent-light: #c97f68;
            --stage: #2b3a4a;
            --border: #e0dbd3;
            --card-bg: #ffffff;
            --card-shadow: 0 12px 28px -8px rgba(0,0,0,0.12), 0 4px 12px rgba(0,0,0,0.02);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--paper);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        /* Background pattern like stage curtains */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(45deg, rgba(176, 101, 77, 0.03) 25%, transparent 25%),
                linear-gradient(-45deg, rgba(176, 101, 77, 0.03) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, rgba(176, 101, 77, 0.03) 75%),
                linear-gradient(-45deg, transparent 75%, rgba(176, 101, 77, 0.03) 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
            pointer-events: none;
            z-index: -1;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            width: 100%;
            max-width: 550px;
            padding: 45px;
            animation: slideUp 0.5s ease;
            border: 1px solid rgba(255,255,255,0.5);
            position: relative;
            overflow: hidden;
        }

        /* Decorative accent line */
        .register-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--accent-light), var(--stage));
            border-radius: 24px 24px 0 0;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo a {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(145deg, #2b1e16, #4a3a32);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            position: relative;
            display: inline-block;
        }

        .logo a::after {
            content: "🎭";
            font-size: 1.5rem;
            margin-left: 10px;
            background: none;
            -webkit-text-fill-color: initial;
            vertical-align: middle;
        }

        h2 {
            text-align: center;
            color: var(--ink);
            margin-bottom: 10px;
            font-size: 2rem;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        .subtitle {
            text-align: center;
            color: var(--muted);
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .demo-notice {
            background: rgba(176, 101, 77, 0.1);
            border: 1px solid var(--accent-light);
            color: var(--accent);
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 0.9rem;
            position: relative;
            overflow: hidden;
        }

        .demo-notice::before {
            content: "🎸";
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .demo-notice.success {
            background: rgba(46, 125, 50, 0.1);
            border-color: #2e7d32;
            color: #2e7d32;
        }

        .demo-notice.success::before {
            content: "✅";
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--ink);
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }

        label i {
            color: var(--accent);
            margin-right: 5px;
            font-style: normal;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
            background: white;
        }

        input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(176, 101, 77, 0.1);
        }

        input:hover {
            border-color: var(--accent-light);
        }

        .password-hint {
            font-size: 0.8rem;
            color: var(--muted);
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .password-hint::before {
            content: "ℹ️";
            font-size: 0.9rem;
        }

        .terms {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 25px 0 20px;
            padding: 15px;
            background: rgba(176, 101, 77, 0.05);
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        .terms input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: var(--accent);
            margin: 0;
            cursor: pointer;
        }

        .terms label {
            margin-bottom: 0;
            font-size: 0.95rem;
            color: var(--ink);
            cursor: pointer;
            flex: 1;
        }

        .terms a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            position: relative;
        }

        .terms a:hover {
            color: var(--accent-light);
        }

        .terms a::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--accent-light);
            transition: width 0.3s;
        }

        .terms a:hover::after {
            width: 100%;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 40px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 0 8px 16px -6px rgba(176, 101, 77, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-register:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(176, 101, 77, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register::after {
            content: "🎫";
            margin-left: 8px;
            font-size: 1.1rem;
        }

        .login-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .login-link a {
            color: var(--accent);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s;
            font-weight: 500;
            position: relative;
            padding-bottom: 2px;
        }

        .login-link a:hover {
            color: var(--accent-light);
        }

        .login-link a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-light);
            transition: width 0.3s;
        }

        .login-link a:hover::after {
            width: 100%;
        }

        .back-home {
            text-align: center;
            margin-top: 25px;
        }

        .back-home a {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-home a:hover {
            color: var(--accent);
        }

        .back-home a::before {
            content: "←";
            font-size: 1.1rem;
        }

        /* Stage lights effect */
        .stage-light {
            position: absolute;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: -1;
        }

        .light-1 {
            top: -50px;
            right: -50px;
        }

        .light-2 {
            bottom: -50px;
            left: -50px;
        }

        /* Password strength indicator */
        .password-strength {
            display: flex;
            gap: 5px;
            margin-top: 8px;
        }

        .strength-bar {
            height: 4px;
            flex: 1;
            background: var(--border);
            border-radius: 2px;
            transition: background 0.3s;
        }

        .strength-bar.active {
            background: var(--accent);
        }

        /* Password match indicator */
        .password-match {
            font-size: 0.8rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .password-match.match {
            color: #2e7d32;
        }

        .password-match.match::before {
            content: "✅";
        }

        .password-match.no-match {
            color: #c53030;
        }

        .password-match.no-match::before {
            content: "❌";
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .register-container {
                padding: 30px 20px;
            }
            
            h2 {
                font-size: 1.8rem;
            }
            
            .terms {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Stage light effects -->
    <div class="stage-light light-1"></div>
    <div class="stage-light light-2"></div>

    <div class="register-container">
        <div class="logo">
            <a href="/">TicketPro</a>
        </div>
        
        <h2>Create Account</h2>
        <p class="subtitle">Join the TicketPro community</p>
        
        <div class="demo-notice">
            Demo Mode: Any information will work
        </div>

        @if(session('message'))
            <div class="demo-notice success">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}" id="registerForm">
            @csrf
            
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">
                        <i>👤</i> First Name
                    </label>
                    <input 
                        type="text" 
                        id="first_name" 
                        name="first_name" 
                        value="John"
                        required 
                        placeholder="First name"
                    >
                </div>

                <div class="form-group">
                    <label for="last_name">
                        <i>👥</i> Last Name
                    </label>
                    <input 
                        type="text" 
                        id="last_name" 
                        name="last_name" 
                        value="Doe"
                        required 
                        placeholder="Last name"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="email">
                    <i>📧</i> Email Address
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="john@example.com"
                    required 
                    placeholder="your.email@example.com"
                >
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">
                        <i>🔐</i> Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        value="password123"
                        required 
                        placeholder="Create password"
                    >
                    <!-- Password strength indicator -->
                    <div class="password-strength">
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                        <div class="strength-bar"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        <i>✓</i> Confirm Password
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        value="password123"
                        required 
                        placeholder="Confirm password"
                    >
                    <!-- Password match indicator -->
                    <div class="password-match match" id="passwordMatchIndicator">
                        Passwords match
                    </div>
                </div>
            </div>
            
            <div class="password-hint">
                Password must be at least 8 characters (demo validation only)
            </div>

            <div class="terms">
                <input type="checkbox" id="terms" name="terms" checked required>
                <label for="terms">
                    I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                </label>
            </div>

            <button type="submit" class="btn-register">Create Account</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>

        <div class="back-home">
            <a href="/">Back to Home</a>
        </div>
    </div>

    <script>
        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const strengthBars = document.querySelectorAll('.strength-bar');
        
        passwordInput.addEventListener('input', function(e) {
            const length = e.target.value.length;
            
            if (length === 0) {
                strengthBars.forEach(bar => bar.classList.remove('active'));
            } else if (length < 4) {
                strengthBars[0].classList.add('active');
                strengthBars[1].classList.remove('active');
                strengthBars[2].classList.remove('active');
                strengthBars[3].classList.remove('active');
            } else if (length < 8) {
                strengthBars[0].classList.add('active');
                strengthBars[1].classList.add('active');
                strengthBars[2].classList.remove('active');
                strengthBars[3].classList.remove('active');
            } else if (length < 12) {
                strengthBars[0].classList.add('active');
                strengthBars[1].classList.add('active');
                strengthBars[2].classList.add('active');
                strengthBars[3].classList.remove('active');
            } else {
                strengthBars.forEach(bar => bar.classList.add('active'));
            }
        });

        // Password match indicator
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const matchIndicator = document.getElementById('passwordMatchIndicator');

        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            if (confirmPassword.length === 0) {
                matchIndicator.style.display = 'none';
                return;
            }
            
            matchIndicator.style.display = 'flex';
            
            if (password === confirmPassword) {
                matchIndicator.className = 'password-match match';
                matchIndicator.textContent = '✓ Passwords match';
            } else {
                matchIndicator.className = 'password-match no-match';
                matchIndicator.textContent = '✗ Passwords do not match';
            }
        }

        passwordInput.addEventListener('input', checkPasswordMatch);
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);
        
        // Initial check (since inputs have default values)
        checkPasswordMatch();
    </script>
</body>
</html>