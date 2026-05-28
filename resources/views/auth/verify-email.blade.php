<x-guest-layout>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f8f3ee, #f1e4da);
    }

    .verify-wrapper {
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
        padding: 40px 20px;
        position: relative; overflow: hidden;
    }

    .verify-wrapper::before {
        content: '';
        position: absolute;
        width: 650px; height: 650px;
        background: radial-gradient(circle, rgba(212,178,156,0.35), transparent 70%);
        top: -260px; right: -180px;
        border-radius: 50%;
    }

    .verify-card {
        width: 100%; max-width: 480px;
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(18px);
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 32px;
        padding: 50px 40px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.08);
        text-align: center;
        position: relative; z-index: 2;
    }

    .verify-icon { font-size: 60px; margin-bottom: 20px; }

    .verify-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.2rem; font-weight: 700;
        color: #5c3b2e; margin-bottom: 12px;
    }

    .verify-text {
        font-size: 14px; color: #8d7365;
        line-height: 1.8; margin-bottom: 28px;
    }

    .verify-email-chip {
        display: inline-block;
        background: #f5ede0;
        border: 1px solid #e2d0bc;
        border-radius: 999px;
        padding: 6px 18px;
        font-size: 13px;
        color: #5c3b2e;
        font-weight: 600;
        margin-bottom: 28px;
    }

    .alert-success {
        background: #edf5e6; border: 1px solid #b8d9a0;
        color: #3d6b2c; border-radius: 14px;
        padding: 13px 16px; font-size: 13px;
        margin-bottom: 20px;
    }

    .resend-btn {
        width: 100%; padding: 16px;
        border: none; border-radius: 18px;
        background: linear-gradient(135deg, #b07d62, #8b5e46);
        color: #fff; font-size: 15px; font-weight: 600;
        cursor: pointer; transition: .3s;
        box-shadow: 0 12px 28px rgba(176,125,98,.28);
        letter-spacing: 0.03em;
    }
    .resend-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 36px rgba(176,125,98,.38);
    }

    .divider {
        display: flex; align-items: center; gap: 12px;
        margin: 22px 0;
        color: #c8b8a8; font-size: 12px;
    }
    .divider::before, .divider::after {
        content: ''; flex: 1;
        border-top: 1px solid #e8d5bd;
    }

    .back-btn {
        width: 100%; padding: 14px;
        border: 1.5px solid #e2d0bc;
        border-radius: 18px;
        background: transparent;
        color: #8d7365; font-size: 14px; font-weight: 500;
        cursor: pointer; transition: .2s;
        font-family: 'Poppins', sans-serif;
    }
    .back-btn:hover {
        border-color: #b07d62;
        color: #b07d62;
        background: #fdf6f0;
    }

    .help-text {
        margin-top: 24px;
        font-size: 12px; color: #b8a898;
        line-height: 1.6;
    }
</style>

<div class="verify-wrapper">
    <div class="verify-card">

        <div class="verify-icon">📬</div>

        <h1 class="verify-title">Check your inbox</h1>

        <p class="verify-text">
            Thanks for joining CrochetCraft! We sent a verification link to:
        </p>

        <div class="verify-email-chip">
            {{ auth()->user()->email }}
        </div>

        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        {{-- RESEND --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="resend-btn">
                ✉ Resend Verification Email
            </button>
        </form>

        <div class="divider">or</div>

        {{-- LOGOUT --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="back-btn">
                ← Back to Login
            </button>
        </form>

        <p class="help-text">
            Didn't get it? Check your spam folder.<br>
            The link expires after 60 minutes.
        </p>

    </div>
</div>

</x-guest-layout>