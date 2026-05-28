<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'CrochetCraft' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- GOOGLE FONTS --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Jost:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --cream: #fdf8f3;
            --cream-dark: #f5ede0;
            --sand: #e7d8c7;
            --terra: #c4693f;
            --terra-dark: #a14f2b;
            --bark: #2e1a0e;
            --bark-soft: #5d4030;
            --white: #ffffff;
            --gray: #7d6b60;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Jost', sans-serif;
            background: var(--cream);
            color: var(--bark);
            overflow-x: hidden;
        }

        /* BACKGROUND GRAIN */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .03;
            z-index: 9999;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160' viewBox='0 0 160 160'%3E%3Cg fill='%23000'%3E%3Ccircle cx='3' cy='3' r='2'/%3E%3C/g%3E%3C/svg%3E");
        }

        /* NAVBAR */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(253, 248, 243, .9);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(0, 0, 0, .05);
        }

        .navbar-inner {
            max-width: 1250px;
            margin: auto;
            padding: 0 40px;
            height: 78px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* LOGO */
        .logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 700;
            text-decoration: none;
            color: var(--bark);
            letter-spacing: -0.5px;
        }

        .logo span {
            color: var(--terra);
        }

        /* NAV LINKS */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 38px;
            list-style: none;
        }

        .nav-links a {
            position: relative;
            text-decoration: none;
            color: var(--bark-soft);
            font-size: .82rem;
            text-transform: uppercase;
            letter-spacing: .14em;
            font-weight: 500;
            transition: .25s;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 0%;
            height: 2px;
            border-radius: 999px;
            background: var(--terra);
            transition: .3s ease;
        }

        .nav-links a:hover {
            color: var(--terra);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* ACTIVE LINK */
        .nav-links .active {
            color: var(--terra);
        }

        .nav-links .active::after {
            width: 100%;
        }

        /* RIGHT ACTIONS */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .icon-btn {
            position: relative;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--bark);
            transition: .25s;
            text-decoration: none;
        }

        .icon-btn:hover {
            background: var(--cream-dark);
            color: var(--terra);
        }

        /* BADGE */
        .badge {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--terra);
            color: white;
            font-size: 9px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* LOGIN BUTTON */
        .btn-login {
            padding: 11px 24px;
            border-radius: 999px;
            background: var(--bark);
            color: white;
            text-decoration: none;
            font-size: .8rem;
            font-weight: 500;
            letter-spacing: .05em;
            transition: .25s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-login:hover {
            background: var(--terra);
            transform: translateY(-2px);
        }

        /* PAGE HEADER */
        .page-header {
            max-width: 1250px;
            margin: auto;
            padding: 60px 40px 20px;
        }

        .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3rem;
            font-weight: 700;
            color: var(--bark);
        }

        .page-subtitle {
            margin-top: 10px;
            color: var(--gray);
            font-size: .95rem;
        }

        /* MAIN CONTENT */
        main {

            margin: auto;
            padding: 20px 40px 80px;
        }

        /* DASHBOARD CARDS */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, .7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, .05);
            border-radius: 28px;
            padding: 28px;
            transition: .3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .04);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .08);
        }

        .card-label {
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--gray);
        }

        .card-value {
            margin-top: 14px;
            font-size: 2.3rem;
            font-weight: 700;
            color: var(--terra);
        }

        /* CONTENT BOX */
        .content-box {
            /* margin-top:35px; */
            /* background:white; */
            border-radius: 30px;
            /* padding:40px; */
            box-shadow: 0 12px 40px rgba(0, 0, 0, .05);
            border: 1px solid rgba(0, 0, 0, .04);
        }

        /* FOOTER */
        footer {
            margin-top: 80px;
            background: var(--bark);
            color: white;
            padding: 70px 40px 30px;
        }

        .footer-inner {
            max-width: 1250px;
            margin: auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 60px;
            padding-bottom: 50px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .footer-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 700;
        }

        .footer-brand span {
            color: var(--terra);
        }

        .footer-desc {
            margin-top: 14px;
            max-width: 320px;
            line-height: 1.8;
            color: rgba(255, 255, 255, .55);
            font-size: .9rem;
        }

        .footer-title {
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .16em;
            margin-bottom: 18px;
            color: white;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            text-decoration: none;
            color: rgba(255, 255, 255, .55);
            transition: .2s;
            font-size: .9rem;
        }

        .footer-links a:hover {
            color: var(--terra);
        }

        .footer-bottom {
            text-align: center;
            margin-top: 26px;
            color: rgba(255, 255, 255, .3);
            font-size: .78rem;
        }

        /* RESPONSIVE */
        @media(max-width:768px) {

            .navbar-inner {
                padding: 0 20px;
            }

            .nav-links {
                display: none;
            }

            .page-header,
            main {
                padding-left: 20px;
                padding-right: 20px;
            }

            .page-title {
                font-size: 2.3rem;
            }

            .content-box {
                padding: 24px;
            }

            footer {
                padding: 50px 20px 24px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }
    </style>

    {{ $styles ?? '' }}
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <div class="navbar-inner">

            <a href="{{ route('dashboard') }}" class="logo">
                Crochet<span>Craft</span>
            </a>

            <ul class="nav-links">
                <li>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            Home
                        </a>
                    @endif
                </li>

                <li>
                    <a href="{{ route('shop') }}">
                        Shop
                    </a>
                </li>

                <li>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('admin.orders') }}">
                            Orders
                        </a>
                    @endif
                </li>

                <li>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('admin.product') }}">
                            Product
                        </a>
                    @endif
                </li>

                @if(auth()->check() && auth()->user()->role === 'admin')
                    <li>
                        <a href="{{ route('admin.categories') }}">
                            Categories
                        </a>
                    </li>
                @endif
            </ul>

            <div class="nav-actions">

                {{-- ✅ NEW — reads from database --}}
@php
    $cartCount = auth()->check()
        ? \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity')
        : 0;
@endphp

{{-- CART ICON WITH BADGE --}}
<a href="{{ route('cart') }}" class="relative">
    🛒
    @if($cartCount > 0)
        <span style="
            position: absolute;
            top: -6px;
            right: -8px;
            background: #c4693f;
            color: white;
            font-size: 10px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        ">{{ $cartCount }}</span>
    @endif
</a>

                {{-- USER --}}
                <a href="{{ route('profile.edit') }}" class="icon-btn">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8"
                        viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </a>



            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main>



        {{-- SLOT --}}
        <div class="content-box">
            {{ $slot }}
        </div>

    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-inner">

            <div class="footer-grid">

                <div>
                    <h2 class="footer-brand">
                        Crochet<span>Craft</span>
                    </h2>

                    <p class="footer-desc">
                        Handmade crochet creations crafted with premium yarn and genuine care. Every piece is designed
                        with passion and creativity.
                    </p>
                </div>

                <div>
                    <h5 class="footer-title">Shop</h5>

                    <ul class="footer-links">
                        <li><a href="#">All Products</a></li>
                        <li><a href="#">Bags</a></li>
                        <li><a href="#">Flowers</a></li>
                        <li><a href="#">Amigurumi</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="footer-title">Support</h5>

                    <ul class="footer-links">
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Custom Orders</a></li>
                    </ul>
                </div>

            </div>

            <p class="footer-bottom">
                © {{ date('Y') }} CrochetCraft · Handmade with Love 🧶
            </p>

        </div>
    </footer>

    {{ $scripts ?? '' }}

</body>

</html>