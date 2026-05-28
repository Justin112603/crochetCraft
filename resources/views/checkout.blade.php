<x-app-layout>

@php
    $user = auth()->user();

    $hasAddress     = !empty($user->address);
    $hasPhone       = !empty($user->phone);
    $profileComplete = $hasAddress && $hasPhone;

    $subtotal = collect($selectedItems)->sum(fn($item) => $item['price'] * $item['quantity']);
    $shipping = 50;
    $total    = $subtotal + $shipping;
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=DM+Sans:wght@300;400;500&display=swap');

    .checkout-page * { font-family: 'DM Sans', sans-serif; }
    .checkout-page .serif { font-family: 'Playfair Display', Georgia, serif; }

    .co-card { background: #fffdf9; border: 1px solid #e8ddd0; border-radius: 22px; }

    .co-input {
        width: 100%; background: #f5ede3; border: 1px solid #e2d0bc;
        border-radius: 12px; padding: 12px 16px; font-size: 14px;
        color: #3e2712; outline: none;
    }
    .co-input[readonly] { cursor: default; color: #7a5c3e; }

    .co-label {
        display: block; font-size: 11px; font-weight: 500;
        letter-spacing: 0.09em; text-transform: uppercase;
        color: #a07858; margin-bottom: 8px;
    }

    .co-info-note {
        background: #fdf4e8; border: 1px solid #eedcc4;
        border-left: 3px solid #c4903f; border-radius: 10px;
        padding: 12px 16px; font-size: 13px; color: #7d6b60; margin-top: 20px;
    }

    .co-warning {
        background: #fff1f0; border: 1px solid #ffc9c5;
        border-left: 4px solid #ff6b57; border-radius: 14px;
        padding: 16px 18px; margin-top: 24px;
    }
    .co-warning-title { font-size: 13px; font-weight: 700; color: #c92a2a; margin-bottom: 6px; }
    .co-warning-text { font-size: 13px; color: #7a4b4b; line-height: 1.6; }
    .co-warning-list { margin-top: 10px; padding-left: 18px; color: #7a4b4b; font-size: 13px; }
    .co-warning-list li { margin-bottom: 5px; }

    .profile-link {
        display: inline-block; margin-top: 14px; text-decoration: none;
        background: #c4693f; color: white; padding: 10px 16px;
        border-radius: 10px; font-size: 13px; font-weight: 500; transition: 0.2s ease;
    }
    .profile-link:hover { background: #a85230; }

    .pay-option {
        display: flex; align-items: center; border: 1.5px solid #e8ddd0;
        border-radius: 16px; padding: 16px 20px; cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        background: #fffdf9; gap: 16px;
    }
    .pay-option:has(input:checked) { border-color: #c4693f; background: #fff9f5; }
    .pay-option:hover { border-color: #d4967a; }

    .pay-radio {
        appearance: none; -webkit-appearance: none;
        width: 18px; height: 18px; border: 1.5px solid #c4a07a;
        border-radius: 50%; background: #fff; cursor: pointer; flex-shrink: 0;
    }
    .pay-radio:checked { border-color: #c4693f; border-width: 5px; }

    .pay-icon {
        width: 42px; height: 42px; border-radius: 10px; background: #f5ede3;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; flex-shrink: 0;
    }

    .order-img {
        width: 56px; height: 56px; object-fit: cover;
        border-radius: 12px; border: 1px solid #eee7da; flex-shrink: 0;
    }

    .place-btn {
        width: 100%; background: #c4693f; color: #fff; border: none;
        border-radius: 14px; padding: 16px 24px; font-size: 15px;
        font-weight: 500; letter-spacing: 0.03em; cursor: pointer;
        transition: background 0.2s, transform 0.15s; margin-top: 24px;
    }
    .place-btn:hover { background: #a85230; transform: translateY(-1px); }
    .place-btn:active { transform: translateY(0); }
    .place-btn-disabled {
        background: #cfc6bd !important; cursor: not-allowed !important;
        pointer-events: none; transform: none !important; opacity: 0.7;
    }

    .totals-row { display: flex; justify-content: space-between; align-items: center; font-size: 13px; }
    .totals-label { color: #9d7d6a; }
    .totals-value { color: #3e2712; font-weight: 500; }

    .page-tag {
        display: inline-block; font-size: 11px; font-weight: 500;
        letter-spacing: 0.12em; text-transform: uppercase; color: #b08060;
        background: #f5ece0; border-radius: 20px; padding: 4px 14px; margin-bottom: 14px;
    }

    .step-dot {
        width: 24px; height: 24px; border-radius: 50%; background: #c4693f;
        color: #fff; font-size: 11px; font-weight: 600;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
</style>

<div class="checkout-page max-w-6xl mx-auto px-5 py-12">

    <div class="mb-10">
        <span class="page-tag">✦ Almost there</span>
        <h1 class="serif text-4xl font-semibold text-[#2e1a0e] leading-tight">Checkout</h1>
        <p class="text-[#9d7d6a] mt-2 text-sm tracking-wide">Review your details and complete your handcrafted order.</p>
    </div>

    <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="grid lg:grid-cols-3 gap-8 items-start">

            {{-- LEFT COLUMN --}}
            <div class="lg:col-span-2 space-y-7">

                {{-- CUSTOMER INFO --}}
                <div class="co-card p-8">
                    <div class="flex items-center gap-3 mb-7">
                        <div class="step-dot">1</div>
                        <h2 class="serif text-xl font-medium text-[#2e1a0e]">Customer Information</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="co-label">Full Name</label>
                            <input type="text" value="{{ $user->name }}" readonly class="co-input">
                        </div>
                        <div>
                            <label class="co-label">Email Address</label>
                            <input type="email" value="{{ $user->email }}" readonly class="co-input">
                        </div>
                        <div>
                            <label class="co-label">Phone Number</label>
                            <input type="text" value="{{ $user->phone ?? 'No phone number added yet' }}" readonly class="co-input">
                        </div>
                        <div>
                            <label class="co-label">Shipping Address</label>
                            <input type="text" value="{{ $user->address ?? 'No address added yet' }}" readonly class="co-input">
                        </div>
                    </div>

                    @if(!$profileComplete)
                        <div class="co-warning">
                            <div class="co-warning-title">⚠ Incomplete Profile Information</div>
                            <div class="co-warning-text">You must complete your profile before placing an order.</div>
                            <ul class="co-warning-list">
                                @if(!$hasPhone)<li>Add your phone number</li>@endif
                                @if(!$hasAddress)<li>Add your shipping address</li>@endif
                            </ul>
                            <a href="{{ route('profile.edit') }}" class="profile-link">Complete Profile →</a>
                        </div>
                    @else
                        <div class="co-info-note">✅ Your delivery details are complete and ready for checkout.</div>
                    @endif
                </div>

                {{-- PAYMENT METHOD --}}
                <div class="co-card p-8">
                    <div class="flex items-center gap-3 mb-7">
                        <div class="step-dot">2</div>
                        <h2 class="serif text-xl font-medium text-[#2e1a0e]">Payment Method</h2>
                    </div>

                    <div class="space-y-3">
                        <label class="pay-option">
                            <input type="radio" name="payment_method" value="cod" checked class="pay-radio">
                            <div class="pay-icon">💵</div>
                            <div>
                                <p class="font-medium text-[#2e1a0e] text-sm">Cash on Delivery</p>
                                <p class="text-xs text-[#9d7d6a] mt-0.5">Pay when your order arrives</p>
                            </div>
                        </label>

                        <label class="pay-option">
                            <input type="radio" name="payment_method" value="gcash" class="pay-radio">
                            <div class="pay-icon">📱</div>
                            <div>
                                <p class="font-medium text-[#2e1a0e] text-sm">GCash</p>
                                <p class="text-xs text-[#9d7d6a] mt-0.5">Fast and secure mobile payment</p>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            {{-- RIGHT: ORDER SUMMARY --}}
            <div class="sticky top-24">
                <div class="co-card p-7">

                    <h2 class="serif text-xl font-medium text-[#2e1a0e] mb-6">Order Summary</h2>

                    {{-- SELECTED ITEMS ONLY --}}
                    <div class="space-y-4 mb-5">
                        @forelse($selectedItems as $item)
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('storage/' . $item['image']) }}"
                                     alt="{{ $item['name'] }}"
                                     class="order-img">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-[#2e1a0e] truncate">{{ $item['name'] }}</p>
                                    <p class="text-xs text-[#9d7d6a] mt-0.5">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <p class="text-sm font-semibold text-[#c4693f] whitespace-nowrap">
                                    ₱{{ number_format($item['price'] * $item['quantity'], 2) }}
                                </p>
                            </div>
                        @empty
                            <p class="text-[#9d7d6a] text-sm">No items selected.</p>
                        @endforelse
                    </div>

                    <hr style="border:none;border-top:1px dashed #e0d3c0;margin-bottom:18px;">

                    <div class="space-y-3">
                        <div class="totals-row">
                            <span class="totals-label">Subtotal</span>
                            <span class="totals-value">₱{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="totals-row">
                            <span class="totals-label">Shipping</span>
                            <span class="totals-value">₱{{ number_format($shipping, 2) }}</span>
                        </div>
                    </div>

                    <hr style="border:none;border-top:1px solid #e8ddd0;margin:16px 0;">

                    <div class="flex justify-between items-baseline">
                        <span class="text-[#2e1a0e] font-medium text-sm">Total</span>
                        <span class="serif text-2xl font-semibold text-[#c4693f]">
                            ₱{{ number_format($total, 2) }}
                        </span>
                    </div>

                    <button type="submit"
                        class="place-btn {{ !$profileComplete ? 'place-btn-disabled' : '' }}"
                        {{ !$profileComplete ? 'disabled' : '' }}>
                        {{ !$profileComplete ? 'Complete Profile First' : 'Place Order →' }}
                    </button>

                    <p class="text-center text-[#c0a888] text-xs mt-4 tracking-wide">
                        Secure checkout · Handcrafted with care
                    </p>

                </div>
            </div>

        </div>
    </form>

</div>

<script>
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const method = document.querySelector('input[name="payment_method"]:checked').value;
        if (method === 'gcash') {
            e.preventDefault();
            window.location.href = "{{ route('gcash.page') }}";
        }
    });
</script>

</x-app-layout>