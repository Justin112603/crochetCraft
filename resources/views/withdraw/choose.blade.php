<x-app-layout>

<x-slot name="title">Choose Withdrawal</x-slot>

<style>
    .withdraw-page{
        max-width:900px;
        margin:auto;
        padding:60px 20px;
    }

    .withdraw-title{
        font-size:2.2rem;
        font-weight:700;
        color:#2e1a0e;
        margin-bottom:10px;
        font-family:'Playfair Display', serif;
    }

    .withdraw-sub{
        color:#8b735f;
        margin-bottom:40px;
    }

    .method-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
        gap:24px;
    }

    .method-card{
        background:#fffdf9;
        border:1px solid #e8ddd0;
        border-radius:24px;
        padding:30px;
        transition:.25s;
        text-decoration:none;
    }

    .method-card:hover{
        transform:translateY(-4px);
        border-color:#c4693f;
        box-shadow:0 15px 35px rgba(0,0,0,0.06);
    }

    .method-icon{
        font-size:2.8rem;
        margin-bottom:16px;
    }

    .method-name{
        font-size:1.3rem;
        font-weight:600;
        color:#2e1a0e;
        margin-bottom:10px;
        font-family:'Playfair Display', serif;
    }

    .method-desc{
        font-size:14px;
        line-height:1.7;
        color:#7d6b60;
    }
</style>

<div class="withdraw-page">

    <div class="withdraw-title">
        Choose Withdrawal Method
    </div>

    <div class="withdraw-sub">
        Select how you would like to receive your commission payout.
    </div>

    <div class="method-grid">

        <a href="{{ route('withdraw.bank') }}" class="method-card">
            <div class="method-icon">💳</div>
            <div class="method-name">Bank Transfer</div>
            <div class="method-desc">
                Withdraw your commission directly to your bank account.
            </div>
        </a>

        <a href="{{ route('withdraw.gcash') }}" class="method-card">
            <div class="method-icon">📱</div>
            <div class="method-name">GCash</div>
            <div class="method-desc">
                Instantly receive your commission through GCash.
            </div>
        </a>

    </div>

</div>

</x-app-layout>