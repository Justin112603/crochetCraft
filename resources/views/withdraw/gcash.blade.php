<x-app-layout>

<x-slot name="title">GCash Withdrawal</x-slot>

<style>
    .withdraw-wrap{
        max-width:600px;
        margin:auto;
        padding:60px 20px;
    }

    .withdraw-card{
        background:#fffdf9;
        border:1px solid #e8ddd0;
        border-radius:24px;
        padding:35px;
    }

    .title{
        font-size:2rem;
        font-family:'Playfair Display', serif;
        color:#2e1a0e;
        margin-bottom:10px;
    }

    .sub{
        color:#8b735f;
        margin-bottom:30px;
    }

    .lbl{
        display:block;
        margin-bottom:8px;
        font-size:13px;
        color:#8b735f;
    }

    .inp{
        width:100%;
        padding:14px;
        border-radius:12px;
        border:1px solid #ddd;
        margin-bottom:20px;
    }

    .btn{
        width:100%;
        padding:15px;
        border:none;
        border-radius:14px;
        background:#c4693f;
        color:white;
        font-weight:600;
        cursor:pointer;
    }
</style>

<div class="withdraw-wrap">

    <div class="withdraw-card">

        <div class="title">GCash Withdrawal</div>

        <div class="sub">
            Enter your GCash details to receive your commission.
        </div>

        <form method="POST" action="{{ route('withdraw.process') }}">
            @csrf

            <input type="hidden" name="method" value="gcash">

            <label class="lbl">GCash Name</label>
            <input type="text"
                   name="account_name"
                   class="inp"
                   required>

            <label class="lbl">GCash Number</label>
            <input type="text"
                   name="account_number"
                   class="inp"
                   required>

            <button class="btn">
                Submit Withdrawal
            </button>

        </form>

    </div>

</div>

</x-app-layout>