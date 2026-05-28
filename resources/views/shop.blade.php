<x-app-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap');

    :root {
        --terra:   #c4693f;
        --terra2:  #a85230;
        --bark:    #2e1a0e;
        --bark2:   #4a2c1a;
        --sand:    #e8d5bd;
        --sand2:   #f0e4d0;
        --cream:   #faf6f0;
        --warm:    #f5ede0;
        --muted:   #9d7d6a;
        --border:  #e2d0bc;
    }

    * { box-sizing: border-box; }

    body { background: var(--cream); }

    .shop-wrap { font-family: 'Jost', sans-serif; color: var(--bark); }
    .serif { font-family: 'Cormorant Garamond', Georgia, serif; }

    /* ── TOP NAV ── */
    .shop-nav {
        background: rgba(250,246,240,0.92);
        backdrop-filter: blur(18px);
        border-bottom: 1px solid var(--border);
        position: sticky; top: 0; z-index: 50;
    }

    .shop-nav-inner {
        max-width: 1400px; margin: 0 auto;
        padding: 0 32px;
        height: 70px;
        display: flex; align-items: center; gap: 28px;
    }

    .shop-logo {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem; font-weight: 600;
        color: var(--bark); text-decoration: none;
        letter-spacing: 0.02em; white-space: nowrap;
    }

    .search-wrap {
        flex: 1; max-width: 560px; position: relative;
    }

    .search-inp {
        width: 100%;
        background: #fff;
        border: 1.5px solid var(--border);
        border-radius: 999px;
        padding: 11px 48px 11px 44px;
        font-family: 'Jost', sans-serif;
        font-size: 14px; color: var(--bark);
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }
    .search-inp:focus {
        border-color: var(--terra);
        box-shadow: 0 0 0 3px rgba(196,105,63,.12);
    }
    .search-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 15px; }
    .search-spinner { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: var(--terra); font-size: 14px; display: none; }
    .search-spinner.active { display: block; animation: spin .7s linear infinite; }
    @keyframes spin { to { transform: translateY(-50%) rotate(360deg); } }

    /* ── CATEGORY CHIPS ── */
    .chips-bar {
        background: var(--cream);
        border-bottom: 1px solid var(--border);
    }
    .chips-inner {
        max-width: 1400px; margin: 0 auto;
        padding: 16px 32px;
        display: flex; gap: 10px;
        overflow-x: auto;
    }
    .chips-inner::-webkit-scrollbar { display: none; }

    .chip {
        white-space: nowrap;
        padding: 8px 20px;
        border-radius: 999px;
        font-family: 'Jost', sans-serif;
        font-size: 13px; font-weight: 500;
        border: 1.5px solid var(--border);
        color: var(--bark2);
        text-decoration: none;
        background: #fff;
        transition: all .2s;
        letter-spacing: 0.02em;
    }
    .chip:hover { border-color: var(--terra); color: var(--terra); background: #fff9f5; }
    .chip.active { background: var(--terra); border-color: var(--terra); color: #fff; }

    /* ── LAYOUT ── */
    .shop-body {
        max-width: 1400px; margin: 0 auto;
        padding: 36px 32px 80px;
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 36px;
        align-items: start;
    }

    /* ── SIDEBAR ── */
    .sidebar {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 24px;
        position: sticky; top: 90px;
    }

    .sidebar-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem; font-weight: 600;
        color: var(--bark);
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--border);
        letter-spacing: 0.04em;
    }

    .filter-label {
        font-size: 11px; font-weight: 600;
        letter-spacing: .1em; text-transform: uppercase;
        color: var(--muted); margin-bottom: 12px;
        display: block;
    }

    .price-display {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.3rem; font-weight: 500;
        color: var(--terra);
    }

    input[type="range"] {
        width: 100%; accent-color: var(--terra);
        margin: 10px 0 6px;
        cursor: pointer;
    }

    .price-bounds {
        display: flex; justify-content: space-between;
        font-size: 12px; color: var(--muted);
    }

    .apply-btn {
        width: 100%;
        background: var(--terra);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 11px;
        font-family: 'Jost', sans-serif;
        font-size: 13px; font-weight: 500;
        cursor: pointer;
        transition: background .2s, transform .15s;
        margin-top: 20px;
        letter-spacing: 0.03em;
    }
    .apply-btn:hover { background: var(--terra2); transform: translateY(-1px); }

    .clear-link {
        display: block; text-align: center;
        margin-top: 10px; font-size: 12px;
        color: var(--muted); text-decoration: none;
        transition: color .15s;
    }
    .clear-link:hover { color: var(--terra); }

    /* ── MAIN ── */
    .main-top {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 24px;
    }

    .result-text {
        font-size: 13px; color: var(--muted); letter-spacing: 0.03em;
    }

    .result-text strong { color: var(--bark); font-weight: 600; }

    .sort-select {
        border: 1.5px solid var(--border);
        border-radius: 12px;
        padding: 9px 16px;
        font-family: 'Jost', sans-serif;
        font-size: 13px; color: var(--bark);
        background: #fff;
        outline: none;
        cursor: pointer;
        transition: border-color .2s;
    }
    .sort-select:focus { border-color: var(--terra); }

    /* ── PRODUCT GRID ── */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
        gap: 20px;
    }

    /* ── PRODUCT CARD ── */
    .product-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        transition: transform .3s ease, box-shadow .3s ease;
        position: relative;
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(46,26,14,.12);
    }

    .card-img-wrap { position: relative; overflow: hidden; }

    .card-img {
        width: 100%; height: 200px;
        object-fit: cover;
        transition: transform .5s ease;
        display: block;
    }
    .product-card:hover .card-img { transform: scale(1.07); }

    .featured-badge {
        position: absolute; top: 12px; left: 12px;
        background: var(--terra); color: #fff;
        font-size: 10px; font-weight: 600;
        letter-spacing: .06em; text-transform: uppercase;
        padding: 4px 10px; border-radius: 999px;
    }

    .out-badge {
        position: absolute; top: 12px; right: 12px;
        background: rgba(239,68,68,.9); color: #fff;
        font-size: 10px; font-weight: 600;
        letter-spacing: .06em; text-transform: uppercase;
        padding: 4px 10px; border-radius: 999px;
    }

    .card-body { padding: 16px; }

    .card-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem; font-weight: 500;
        color: var(--bark); line-height: 1.35;
        display: -webkit-box; -webkit-line-clamp: 2;
        -webkit-box-orient: vertical; overflow: hidden;
        min-height: 2.7rem;
    }

    .card-price {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.3rem; font-weight: 600;
        color: var(--terra); margin-top: 8px;
    }

    .card-stock {
        font-size: 11px; color: var(--muted);
        margin-top: 3px; letter-spacing: .03em;
    }

    .card-stock.out { color: #ef4444; font-weight: 600; }

    .add-btn {
        width: 100%; margin-top: 12px;
        background: var(--bark);
        color: #fff; border: none;
        border-radius: 12px; padding: 11px;
        font-family: 'Jost', sans-serif;
        font-size: 13px; font-weight: 500;
        cursor: pointer; letter-spacing: 0.04em;
        transition: background .2s, transform .15s;
    }
    .add-btn:hover { background: var(--terra); transform: translateY(-1px); }
    .add-btn:active { transform: translateY(0); }
    .add-btn.disabled {
        background: #e2d8d0; color: #b8a898;
        cursor: not-allowed; transform: none;
    }

    /* ── LOAD MORE ── */
    .load-more-wrap { text-align: center; margin-top: 48px; }

    .load-more-btn {
        padding: 14px 40px;
        border: 1.5px solid var(--terra);
        color: var(--terra);
        background: transparent;
        border-radius: 999px;
        font-family: 'Jost', sans-serif;
        font-size: 14px; font-weight: 500;
        cursor: pointer; letter-spacing: 0.06em;
        transition: all .2s;
    }
    .load-more-btn:hover { background: var(--terra); color: #fff; }
    .load-more-btn:disabled { opacity: .5; cursor: not-allowed; }

    .seen-all {
        font-size: 13px; color: var(--muted);
        letter-spacing: .05em;
    }

    /* ── EMPTY ── */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center; padding: 80px 32px;
    }
    .empty-icon { font-size: 56px; margin-bottom: 16px; opacity: .5; }
    .empty-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem; color: var(--bark); margin-bottom: 8px;
    }
    .empty-sub { font-size: 14px; color: var(--muted); }
    .empty-link {
        display: inline-block; margin-top: 20px;
        background: var(--terra); color: #fff;
        padding: 12px 28px; border-radius: 12px;
        font-size: 14px; text-decoration: none;
        transition: background .2s;
    }
    .empty-link:hover { background: var(--terra2); }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
        .shop-body { grid-template-columns: 1fr; }
        .sidebar { display: none; }
    }
    @media (max-width: 640px) {
        .shop-nav-inner { padding: 0 16px; }
        .chips-inner { padding: 12px 16px; }
        .shop-body { padding: 24px 16px 60px; }
        .product-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    }

    /* ── CARD ENTER ANIMATION ── */
    @keyframes cardIn {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .product-card { animation: cardIn .35s ease both; }
</style>

<div class="shop-wrap">

    {{-- ── NAV ── --}}
    <nav class="shop-nav">
        <div class="shop-nav-inner">
            <a href="/" class="shop-logo">CrochetCraft</a>

            <div class="search-wrap">
                <form method="GET" action="{{ route('shop') }}">
                    <input type="hidden" name="category"  value="{{ request('category') }}">
                    <input type="hidden" name="sort"      value="{{ request('sort') }}">
                    <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                    <span class="search-icon">🔍</span>
                    <input type="text"
                           name="search"
                           id="searchInput"
                           value="{{ request('search') }}"
                           autocomplete="off"
                           class="search-inp"
                           placeholder="Search handmade crochet items...">
                    <span class="search-spinner" id="searchSpinner">↻</span>
                </form>
            </div>
        </div>
    </nav>

    {{-- ── CATEGORY CHIPS ── --}}
    <div class="chips-bar">
        <div class="chips-inner">
            <a href="{{ route('shop', array_merge(request()->except('category'), ['category' => 'all'])) }}"
               class="chip {{ !request('category') || request('category') === 'all' ? 'active' : '' }}">
                All
            </a>
            @foreach($categories as $category)
                <a href="{{ route('shop', array_merge(request()->except('category'), ['category' => $category->slug])) }}"
                   class="chip {{ request('category') === $category->slug ? 'active' : '' }}">
                    {{ $category->icon }} {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- ── BODY ── --}}
    <div class="shop-body">

        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-title">Filters</div>

            <form method="GET" action="{{ route('shop') }}" id="filterForm">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <input type="hidden" name="search"   value="{{ request('search') }}">
                <input type="hidden" name="sort"     value="{{ request('sort') }}">

                <span class="filter-label">Price Range</span>
                <div class="price-display" id="priceLabel">₱{{ request('max_price', 2000) }}</div>

                <input type="range"
                       name="max_price"
                       id="priceRange"
                       min="100" max="2000" step="50"
                       value="{{ request('max_price', 2000) }}"
                       oninput="document.getElementById('priceLabel').innerText = '₱' + this.value">

                <div class="price-bounds"><span>₱100</span><span>₱2,000</span></div>

                <button type="submit" class="apply-btn">Apply Filters</button>

                @if(request()->hasAny(['search','category','max_price','sort']))
                    <a href="{{ route('shop') }}" class="clear-link">✕ Clear all filters</a>
                @endif
            </form>
        </aside>

        {{-- MAIN --}}
        <div>

            <div class="main-top">
                <p class="result-text">
                    Showing <strong id="resultCount">{{ $products->total() }}</strong> products
                </p>

                <form method="GET" action="{{ route('shop') }}">
                    <input type="hidden" name="category"  value="{{ request('category') }}">
                    <input type="hidden" name="search"    value="{{ request('search') }}">
                    <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                    <select name="sort" onchange="this.form.submit()" class="sort-select">
                        <option value=""          {{ request('sort') == ''          ? 'selected':'' }}>Popularity</option>
                        <option value="newest"    {{ request('sort') == 'newest'    ? 'selected':'' }}>Newest First</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected':'' }}>Price: Low → High</option>
                        <option value="price_desc"{{ request('sort') == 'price_desc'? 'selected':'' }}>Price: High → Low</option>
                    </select>
                </form>
            </div>

            {{-- PRODUCT GRID --}}
            <div class="product-grid" id="productGrid">
                @forelse($products as $i => $product)
                    <div class="product-card" style="animation-delay: {{ $i * 0.04 }}s">
                        <div class="card-img-wrap">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="card-img"
                                 alt="{{ $product->name }}">
                            @if($product->is_featured)
                                <span class="featured-badge">Featured</span>
                            @endif
                            @if($product->stock <= 0)
                                <span class="out-badge">Sold Out</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="card-name">{{ $product->name }}</div>
                            <div class="card-price">₱{{ number_format($product->price, 2) }}</div>
                            @if($product->stock <= 0)
                                <div class="card-stock out">Out of stock</div>
                                <button class="add-btn disabled" disabled>Unavailable</button>
                            @else
                                <div class="card-stock">{{ $product->stock }} left</div>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="add-btn">Add to Cart</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">🧶</div>
                        <div class="empty-title">Nothing found</div>
                        <p class="empty-sub">Try adjusting your search or filters.</p>
                        <a href="{{ route('shop') }}" class="empty-link">Clear filters</a>
                    </div>
                @endforelse
            </div>

            {{-- LOAD MORE --}}
            <div class="load-more-wrap" id="loadMoreContainer">
                @if($products->hasMorePages())
                    <button onclick="loadMore()" id="loadMoreBtn" class="load-more-btn">
                        Load More
                    </button>
                @endif
            </div>

        </div>
    </div>
</div>

<script>
    let currentPage = {{ $products->currentPage() }};
    let lastPage    = {{ $products->lastPage() }};
    let searchTimer = null;

    // ── REAL-TIME SEARCH ──
    document.getElementById('searchInput').addEventListener('input', function () {
        clearTimeout(searchTimer);
        const spinner = document.getElementById('searchSpinner');
        spinner.classList.add('active');

        searchTimer = setTimeout(() => {
            const params = new URLSearchParams(window.location.search);
            params.set('search', this.value);
            params.set('ajax', '1');
            params.delete('page');

            fetch('{{ route('shop') }}?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                spinner.classList.remove('active');
                document.getElementById('productGrid').innerHTML = data.html;
                document.getElementById('resultCount').innerText = data.total;
                lastPage    = data.last_page;
                currentPage = 1;

                const container = document.getElementById('loadMoreContainer');
                container.innerHTML = data.last_page > 1
                    ? `<button onclick="loadMore()" id="loadMoreBtn" class="load-more-btn">Load More</button>`
                    : '';

                const clean = new URLSearchParams(Object.fromEntries(params.entries()));
                clean.delete('ajax');
                window.history.pushState({}, '', '{{ route('shop') }}?' + clean.toString());
            })
            .catch(() => spinner.classList.remove('active'));
        }, 400);
    });

    // ── LOAD MORE ──
    function loadMore() {
        const btn = document.getElementById('loadMoreBtn');
        btn.innerText = 'Loading...';
        btn.disabled  = true;

        const params = new URLSearchParams(window.location.search);
        params.set('page',  currentPage + 1);
        params.set('ajax', '1');

        fetch('{{ route('shop') }}?' + params.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('productGrid').insertAdjacentHTML('beforeend', data.html);
            currentPage++;
            lastPage = data.last_page;

            const container = document.getElementById('loadMoreContainer');
            if (currentPage >= lastPage) {
                container.innerHTML = '<p class="seen-all">✦ You\'ve seen everything ✦</p>';
            } else {
                btn.innerText = 'Load More';
                btn.disabled  = false;
            }
        })
        .catch(() => {
            btn.innerText = 'Load More';
            btn.disabled  = false;
        });
    }
</script>

</x-app-layout>