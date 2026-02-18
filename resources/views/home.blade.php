<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--paper);
            color: var(--ink);
            line-height: 1.5;
        }

        a { text-decoration: none; }

        .site-header {
            background: rgba(255, 255, 255, 0.92);
            border-bottom: 1px solid var(--border);
            padding: 1.2rem 4rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(12px);
        }

        .header-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(145deg, #2b1e16, #4a3a32);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .btn-login {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--ink);
            padding: 0.5rem 1.2rem;
            border-radius: 30px;
            border: 1px solid var(--border);
            transition: 0.2s;
            background: white;
        }

        .btn-login:hover {
            background: #f5f0eb;
            border-color: var(--accent-light);
            color: var(--accent);
        }

        .btn-register {
            background: var(--accent);
            padding: 0.6rem 1.5rem;
            color: white;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.9rem;
            box-shadow: 0 8px 16px -6px rgba(176, 101, 77, 0.3);
            transition: 0.2s;
        }
        
        .btn-register:hover { 
            background: var(--accent-light); 
            transform: scale(1.02); 
        }

        .hero {
            position: relative;
            background: url('https://images.unsplash.com/photo-1501612780327-45045538702b?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
            color: white;
            text-align: center;
            padding: 7rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(107deg, rgba(0,0,0,0.6) 0%, rgba(20,20,30,0.7) 100%);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 750px;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.8rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            text-shadow: 0 2px 20px rgba(0,0,0,0.5);
            letter-spacing: -0.02em;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2.2rem;
            opacity: 0.95;
            font-weight: 300;
        }

        .hero a.btn-hero {
            padding: 0.9rem 2.8rem;
            background: var(--accent);
            color: white;
            border-radius: 40px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.3px;
            box-shadow: 0 20px 30px -10px #b0654d80;
            transition: 0.25s;
            display: inline-block;
            border: 1px solid rgba(255,255,255,0.15);
        }
        
        .hero a.btn-hero:hover { 
            background: #c97f68; 
            transform: scale(1.04); 
            box-shadow: 0 25px 30px -8px #b0654d; 
        }

        section {
            padding: 5rem 2rem;
            max-width: 1280px;
            margin: 0 auto;
        }

        h2.section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            text-align: center;
            letter-spacing: -0.02em;
            background: linear-gradient(145deg, #2f2a24, #4e3f35);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p.section-sub {
            color: var(--muted);
            text-align: center;
            margin-bottom: 3.5rem;
            font-size: 1.1rem;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .card {
            background: var(--card-bg);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all 0.3s cubic-bezier(0.2,0,0,1);
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(255,255,255,0.5);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 40px -12px rgba(0,0,0,0.25);
        }

        .card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid var(--accent-light);
            transition: transform 0.5s;
        }

        .card:hover .card-img {
            transform: scale(1.02);
        }

        .card-content {
            padding: 1.8rem 1.5rem 2rem;
            background: white;
        }

        .card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 0 0.4rem 0;
            color: #1e1e24;
        }

        .card p {
            color: #4a4a55;
            font-size: 0.95rem;
            margin-bottom: 1.4rem;
            line-height: 1.5;
        }

        .card .card-status {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.4rem 1rem;
            border-radius: 40px;
            background: var(--accent);
            color: white;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .card[data-category="stage"] .card-status {
            background: var(--stage);
        }

        footer {
            background: #161616;
            color: #f0f0f0;
            padding: 4rem 2rem 3rem;
            margin-top: 3rem;
        }

        footer .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        footer .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(130deg, #d6b59e, #f0ddd0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        footer .footer-copy {
            font-size: 0.85rem;
            color: #aaa;
        }

        footer .footer-links {
            display: flex;
            gap: 2.5rem;
        }

        footer .footer-links a {
            color: #bbb;
            font-size: 0.9rem;
            transition: 0.2s;
            border-bottom: 1px dotted transparent;
        }

        footer .footer-links a:hover { 
            color: #f0c3aa; 
            border-bottom-color: #b0654d; 
        }

        @media(max-width:768px){
            .header-container { 
                flex-direction: column; 
                gap: 1rem; 
            }
            .nav { 
                flex-wrap: wrap; 
                justify-content: center; 
                gap: 1rem; 
            }
            .hero h1 { 
                font-size: 2.5rem; 
            }
            .hero p { 
                font-size: 1.1rem; 
            }
            h2.section-title { 
                font-size: 2rem; 
            }
        }
    </style>
    <title>TicketPro · Concerts & Stages</title>
</head>
<body>

<!-- HEADER with only login & register -->
<header class="site-header">
    <div class="header-container">
        <div class="logo">TicketPro</div>

        <nav class="nav">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-register">Dashboard</a>
            @else
                <a href="{{ url('login') }}" class="btn-login">Log in</a>
                <a href="{{ url('register') }}" class="btn-register">Register</a>
            @endauth
        </nav>
    </div>
</header>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h1>Feel the rhythm,<br> grab your pass</h1>
        <p>Live concerts, exclusive stage performances & backstage experiences — all in one seamless ticket hub.</p>
        <a href="#view-events" class="btn-hero">Explore events</a>
    </div>
</section>

<!-- VIEW EVENTS -->
<section id="view-events">
    <h2 class="section-title">View events</h2>
    <p class="section-sub">electrifying concerts & captivating stage shows</p>
    <div class="cards">
        <div class="card" data-category="concert">
            <img class="card-img" src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?q=80&w=1974&auto=format&fit=crop" alt="crowd at concert">
            <div class="card-content">
                <h3>Neon Lights Open Air</h3>
                <p>Alternative/indie night with The Velvets & Aurora Wave. Lawn seats + light show.</p>
                <span class="card-status">ON SALE</span>
            </div>
        </div>
        <div class="card" data-category="stage">
            <img class="card-img" src="https://images.unsplash.com/photo-1503095396549-807759245b35?q=80&w=2071&auto=format&fit=crop" alt="stage play performance">
            <div class="card-content">
                <h3>Hamlet · modern adaptation</h3>
                <p>Royal Theatre company presents a bold reinterpretation. Limited balcony seats.</p>
                <span class="card-status">OPEN</span>
            </div>
        </div>
        <div class="card" data-category="concert">
            <img class="card-img" src="https://images.unsplash.com/photo-1459749411175-04bf5292f2cd?q=80&w=2070&auto=format&fit=crop" alt="live concert atmosphere">
            <div class="card-content">
                <h3>Eclipse World Tour</h3>
                <p>DJ Phoenix + special guests. Laser & pyrotechnics show. VIP packages available.</p>
                <span class="card-status">LAST CHANCE</span>
            </div>
        </div>
    </div>
</section>

<!-- UPCOMING EVENTS -->
<section id="upcoming-events">
    <h2 class="section-title">Upcoming events</h2>
    <p class="section-sub">mark your calendar — intimate concerts & drama</p>
    <div class="cards">
        <div class="card" data-category="stage">
            <img class="card-img" src="https://images.unsplash.com/photo-1585699324551-f6c309eedeca?q=80&w=2070&auto=format&fit=crop" alt="theatre stage with red curtain">
            <div class="card-content">
                <h3>Macbeth · physical theatre</h3>
                <p>Immersive staging at The Warehouse. Only 80 seats per night.</p>
                <span class="card-status">PREVIEW</span>
            </div>
        </div>
        <div class="card" data-category="concert">
            <img class="card-img" src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=2070&auto=format&fit=crop" alt="singer acoustic concert">
            <div class="card-content">
                <h3>Acoustic session: Madilyn</h3>
                <p>Rooftop unplugged series. Early access for members.</p>
                <span class="card-status">WAITLIST</span>
            </div>
        </div>
        <div class="card" data-category="stage">
            <img class="card-img" src="https://images.unsplash.com/photo-1514306191717-452ec28c7814?q=80&w=2069&auto=format&fit=crop" alt="multimedia stage performance">
            <div class="card-content">
                <h3>Cirque Nova · 'Lumina'</h3>
                <p>Projection mapping & aerial performance. World premiere.</p>
                <span class="card-status">UPCOMING</span>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-container">
        <div class="footer-logo">TicketPro</div>
        <div class="footer-copy">&copy; {{ date('Y') }} TicketPro. All rights reserved.</div>
        <div class="footer-links">
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
            <a href="#">Contact</a>
        </div>
    </div>
</footer>

</body>
</html>