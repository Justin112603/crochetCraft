
    <div class="order-card">
    <div class="order-top">
        <div>
            <div class="order-id">#ORDER-{{ $order->id }}</div>
            <div class="order-date">{{ $order->created_at->format('F d, Y') }}</div>
        </div>
        <span class="badge badge-{{ strtolower(str_replace(' ', '-', $order->status)) }}">
            {{ ucfirst($order->status) }}
        </span>
    </div>
    <div class="order-foot">
        <div class="order-amt">₱{{ number_format($order->total, 2) }}</div>
        <button class="btn-sm" onclick="openOrderModal(
            '{{ $order->id }}',
            '{{ $order->created_at->format('F d, Y h:i A') }}',
            '{{ ucfirst($order->status) }}',
            '{{ number_format($order->subtotal, 2) }}',
            '{{ number_format($order->total, 2) }}',
            '{{ $order->payment_method }}',
            '{{ asset('storage/' . $order->image) }}',
            '{{ addslashes($order->product->name ?? 'Product') }}',
            '{{ $order->quantity ?? 1 }}',
            '{{ addslashes(auth()->user()->name) }}',
            '{{ auth()->user()->email }}',
            '{{ auth()->user()->phone ?? 'No phone number' }}',
            '{{ addslashes(auth()->user()->address ?? 'No address added') }}'
        )">{{ $btnLabel ?? 'View' }}</button>
    </div>
</div>
