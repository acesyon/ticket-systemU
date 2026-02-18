<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TicketPro</title>
    
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

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            animation: slideUp 0.5s ease;
            border: 1px solid rgba(255,255,255,0.5);
            position: relative;
            overflow: hidden;
        }

        /* Decorative accent line */
        .login-container::before {
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

        .form-group {
            margin-bottom: 25px;
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

        .btn-login {
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
            margin-top: 15px;
            box-shadow: 0 8px 16px -6px rgba(176, 101, 77, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(176, 101, 77, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login::after {
            content: "🎫";
            margin-left: 8px;
            font-size: 1.1rem;
        }

        .links {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .links a {
            color: var(--accent);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s;
            font-weight: 500;
            position: relative;
            padding-bottom: 2px;
        }

        .links a:hover {
            color: var(--accent-light);
        }

        .links a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-light);
            transition: width 0.3s;
        }

        .links a:hover::after {
            width: 100%;
        }

        .links .separator {
            color: var(--border);
            margin: 0 15px;
            font-weight: 300;
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

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            h2 {
                font-size: 1.8rem;
            }
        }

        /* Password strength indicator (visual only) */
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
        }

        .strength-bar.active {
            background: var(--accent);
        }
    </style>
</head>
<body>
    <!-- Stage light effects -->
    <div class="stage-light light-1"></div>
    <div class="stage-light light-2"></div>

    <div class="login-container">
        <div class="logo">
            <a href="/">TicketPro</a>
        </div>
        
        <h2>Welcome Back!</h2>
        <p class="subtitle">Please login to your account</p>
        
        @if(session('success'))
            <div class="demo-notice success">
                {{ session('success') }}
            </div>
        @else
            <div class="demo-notice">
                Demo Mode: Any email/password will work
            </div>
        @endif

        @if(session('message'))
            <div class="demo-notice success">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">
                    <i>📧</i> Email Address
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="test@example.com"
                    required 
                    autofocus
                    placeholder="your.email@example.com"
                >
            </div>

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
                    placeholder="••••••••"
                >
                <!-- Visual password strength indicator (demo only) -->
                <div class="password-strength">
                    <div class="strength-bar active"></div>
                    <div class="strength-bar active"></div>
                    <div class="strength-bar active"></div>
                    <div class="strength-bar"></div>
                </div>
            </div>

            <button type="submit" class="btn-login">Log In</button>
        </form>

        <div class="links">
            <a href="{{ route('register') }}">Create an account</a>
            <span class="separator">|</span>
            <a href="#">Forgot password?</a>
        </div>

        <div class="back-home">
            <a href="/">Back to Home</a>
        </div>
    </div>

    <script>
        // Visual feedback for password strength (just for demo)
        document.getElementById('password').addEventListener('input', function(e) {
            const bars = document.querySelectorAll('.strength-bar');
            const length = e.target.value.length;
            
            if (length === 0) {
                bars.forEach(bar => bar.classList.remove('active'));
            } else if (length < 4) {
                bars[0].classList.add('active');
                bars[1].classList.remove('active');
                bars[2].classList.remove('active');
                bars[3].classList.remove('active');
            } else if (length < 8) {
                bars[0].classList.add('active');
                bars[1].classList.add('active');
                bars[2].classList.remove('active');
                bars[3].classList.remove('active');
            } else if (length < 12) {
                bars[0].classList.add('active');
                bars[1].classList.add('active');
                bars[2].classList.add('active');
                bars[3].classList.remove('active');
            } else {
                bars.forEach(bar => bar.classList.add('active'));
            }
        });
    </script>
</body>
</html>