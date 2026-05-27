<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CrochetCraft</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --cream: #f8f3ee;
            --nude: #e4c7b8;
            --brown: #8b5e3c;
            --dark: #4b3124;
            --light: #fffdfb;
            --soft: #d9b8a6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #fffdfb, #f8f3ee);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* NAVBAR */

        .navbar {
            width: 100%;
            padding: 22px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(139, 94, 60, 0.08);
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            font-family: 'Cormorant Garamond', serif;
            color: var(--dark);
            letter-spacing: 1px;
        }

        .logo span {
            color: var(--brown);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-size: 0.95rem;
            font-weight: 500;
            transition: .3s;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 0%;
            height: 2px;
            background: var(--brown);
            transition: .3s;
        }

        .nav-links a:hover {
            color: var(--brown);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .login-btn {
            background: var(--brown);
            color: white !important;
            padding: 12px 26px;
            border-radius: 999px;
            box-shadow: 0 10px 25px rgba(139, 94, 60, 0.25);
        }

        .login-btn::after {
            display: none;
        }

        .login-btn:hover {
            background: #6d472c;
            transform: translateY(-2px);
        }

        /* HERO */

        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            padding: 140px 8% 80px;
            gap: 60px;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(228, 199, 184, 0.45), transparent 70%);
            top: -250px;
            right: -150px;
            border-radius: 50%;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .tag {
            display: inline-block;
            padding: 10px 22px;
            background: rgba(228, 199, 184, 0.25);
            color: var(--brown);
            border-radius: 999px;
            font-size: 0.78rem;
            letter-spacing: 2px;
            font-weight: 600;
            margin-bottom: 28px;
        }

        .hero h1 {
            font-size: 5.5rem;
            line-height: 0.95;
            font-family: 'Cormorant Garamond', serif;
            margin-bottom: 24px;
            color: var(--dark);
        }

        .hero h1 span {
            color: var(--brown);
            font-style: italic;
        }

        .hero p {
            font-size: 1rem;
            line-height: 1.9;
            color: #6f5a4e;
            max-width: 520px;
            margin-bottom: 40px;
        }

        .hero-buttons {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: var(--brown);
            color: white;
            text-decoration: none;
            padding: 15px 34px;
            border-radius: 999px;
            font-weight: 600;
            transition: .3s;
            box-shadow: 0 12px 30px rgba(139, 94, 60, 0.25);
        }

        .btn-primary:hover {
            background: #6d472c;
            transform: translateY(-3px);
        }

        .btn-secondary {
            border: 1.5px solid var(--soft);
            color: var(--dark);
            text-decoration: none;
            padding: 15px 34px;
            border-radius: 999px;
            font-weight: 500;
            transition: .3s;
            background: white;
        }

        .btn-secondary:hover {
            border-color: var(--brown);
            color: var(--brown);
        }

        /* HERO IMAGE */

        .hero-image {
            position: relative;
            z-index: 2;
        }

        .hero-image img {
            width: 100%;
            height: 650px;
            object-fit: cover;
            border-radius: 40px 120px 40px 120px;
            box-shadow: 0 35px 80px rgba(75, 49, 36, 0.18);
        }

        .floating-card {
            position: absolute;
            bottom: 30px;
            left: -40px;
            background: white;
            padding: 22px 26px;
            border-radius: 24px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12);
        }

        .floating-card h3 {
            font-size: 1.1rem;
            margin-bottom: 6px;
            color: var(--dark);
        }

        .floating-card p {
            font-size: 0.85rem;
            color: #8a7568;
        }

        /* SECTION */

        .section {
            padding: 100px 8%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3rem;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .section-title p {
            color: #7c6759;
        }

        /* CARDS */

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            transition: .35s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        .card-body {
            padding: 24px;
        }

        .card-body h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            font-family: 'Cormorant Garamond', serif;
            color: var(--dark);
        }

        .card-body p {
            color: #7d6a5e;
            line-height: 1.7;
            font-size: 0.92rem;
        }

        /* PROMO */

        .promo {
            background: linear-gradient(135deg, #8b5e3c, #c8a58f);
            padding: 90px 8%;
            border-radius: 40px;
            margin: 80px 8%;
            text-align: center;
            color: white;
        }

        .promo h2 {
            font-size: 3.2rem;
            font-family: 'Cormorant Garamond', serif;
            margin-bottom: 18px;
        }

        .promo p {
            max-width: 650px;
            margin: auto;
            line-height: 1.9;
            opacity: 0.92;
            margin-bottom: 35px;
        }

        .promo a {
            display: inline-block;
            padding: 15px 34px;
            background: white;
            color: var(--brown);
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
            transition: .3s;
        }

        .promo a:hover {
            transform: translateY(-3px);
        }

        footer {
            text-align: center;
            padding: 40px;
            color: #8a7568;
            font-size: 0.9rem;
        }

        /* RESPONSIVE */

        @media(max-width:992px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 4rem;
            }

            .hero-image img {
                height: 500px;
            }
        }

        @media(max-width:768px) {

            .navbar {
                padding: 20px;
            }

            .nav-links {
                gap: 18px;
            }

            .hero {
                padding: 130px 20px 60px;
            }

            .hero h1 {
                font-size: 3.2rem;
            }

            .hero-image img {
                height: 420px;
                border-radius: 30px;
            }

            .floating-card {
                left: 15px;
                bottom: 15px;
            }

            .section {
                padding: 70px 20px;
            }

            .promo {
                margin: 40px 20px;
                padding: 70px 20px;
            }

            .promo h2 {
                font-size: 2.3rem;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <div class="logo">
            Crochet<span>Craft</span>
        </div>

        <div class="nav-links">
            <a href="#">HOME</a>
            <a href="#shop">SHOP</a>
            <a href="#promo">PROMOTIONS</a>
            <a href="{{ route('login') }}" class="login-btn">LOGIN</a>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="hero">

        <div class="hero-content">
            <div class="tag">✦ HANDMADE CROCHET COLLECTION</div>

            <h1>
                Elegant <span>Handmade</span><br>
                Crochet Pieces
            </h1>

            <p>
                Discover beautifully crafted crochet bags, flowers, plushies,
                and accessories designed with love and timeless artistry.
                A modern boutique experience with soft nude brown aesthetics.
            </p>

            <div class="hero-buttons">
                <a href="#shop" class="btn-primary">Shop Now</a>
                <a href="#promo" class="btn-secondary">View Promotions</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="{{ asset('img/image.png') }}">
            <div class="floating-card">
                <h3>100% Handmade</h3>
                <p>Premium crochet crafted with care</p>
            </div>
        </div>

    </section>

    {{-- SHOP --}}
    <section class="section" id="shop">

        <div class="section-title">
            <h2>Featured Collection</h2>
            <p>Minimalist crochet pieces with modern nude brown aesthetics</p>
        </div>

        <div class="cards">

            <div class="card">
                <img src="{{ asset('img/teddy.png') }}">
                <div class="card-body">
                    <h3>Crochet Teddy</h3>
                    <p>Soft handcrafted amigurumi perfect for gifts and collections.</p>
                </div>
            </div>

            <div class="card">
                <img src="{{ asset('img/bag.png') }}">
                <div class="card-body">
                    <h3>Tote Bag</h3>
                    <p>Elegant handmade tote designed with natural cotton textures.</p>
                </div>
            </div>

            <div class="card">
                <img src="{{ asset('img/hats.png') }}">
                <div class="card-body">
                    <h3>Hat</h3>
                    <p>Breathable and stylish crochet hats for everyday fashion.</p>
                </div>
            </div>

        </div>

    </section>

    {{-- PROMOTION --}}
    <section class="promo" id="promo">
        <h2>Summer Nude Collection</h2>

        <p>
            Enjoy exclusive discounts on selected handmade crochet collections.
            Experience premium handcrafted elegance with warm nude brown tones.
        </p>

        <a href="#">Shop Promotions</a>
    </section>

    <footer>
        © {{ date('Y') }} CrochetCraft — Handmade with elegance & love.
    </footer>

</body>

</html>