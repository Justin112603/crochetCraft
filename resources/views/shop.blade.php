<x-app-layout>

    <style>
        :root {
            --terra: #c4693f;
            --bark: #2e1a0e;
            --sand: #e8d5bd;
            --cream: #f8f1e9;
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .product-img {
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-img {
            transform: scale(1.08);
        }

        .category-chip {
            transition: all 0.2s ease;
            background: white;
        }

        .category-chip.active {
            background: var(--terra);
            color: white;
            transform: translateY(-2px);
        }

        .category-chip:hover {
            background: var(--terra);
            color: white;
        }

        .price {
            font-family: 'Cormorant Garamond', serif;
        }
    </style>

    <div class="bg-[#f8f1e9] min-h-screen">

        <!-- Top Search & Nav -->
        <div class="border-b sticky top-0 z-50 shadow-sm bg-white">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="flex items-center gap-4">
                    <a href="/" class="text-2xl font-bold text-[#2e1a0e]">CrochetCraft</a>
                    <div class="flex-1 max-w-2xl">
                        <form method="GET" action="{{ route('shop') }}">
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                            <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" id="searchInput"
                                    autocomplete="off"
                                    class="w-full border border-[#e8d5bd] rounded-full py-3 px-5 pl-12 focus:outline-none focus:border-[#c4693f] bg-white"
                                    placeholder="Search handmade crochet items...">
                                <span class="absolute left-5 top-3.5 text-gray-400">🔍</span>
                                <span id="searchSpinner"
                                    class="absolute right-5 top-3.5 hidden text-[#c4693f] text-sm animate-spin">⟳</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Chips -->
        <div class="max-w-7xl mx-auto px-4 py-6 border-b">
            <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                <a href="{{ route('shop', array_merge(request()->except('category'), ['category' => 'all'])) }}"
                    class="category-chip {{ !request('category') || request('category') === 'all' ? 'active' : '' }} whitespace-nowrap px-6 py-2.5 rounded-3xl text-sm font-medium border border-[#c4693f] text-[#c4693f]">
                    All
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('shop', array_merge(request()->except('category'), ['category' => $category->slug])) }}"
                        class="category-chip {{ request('category') === $category->slug ? 'active' : '' }} whitespace-nowrap px-6 py-2.5 rounded-3xl text-sm font-medium border border-[#e8d5bd] text-[#5d4030]">
                        {{ $category->icon }} {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-8 flex gap-8">

            <!-- Sidebar Filters -->
            <div class="w-64 hidden lg:block">
                <form method="GET" action="{{ route('shop') }}" id="filterForm">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">

                    <h3 class="font-semibold mb-4 text-[#2e1a0e]">Filters</h3>

                    <div class="mb-6">
                        <p class="text-sm font-medium mb-3">Max Price: <span
                                id="priceLabel">₱{{ request('max_price', 2000) }}</span></p>
                        <input type="range" name="max_price" id="priceRange" class="w-full accent-[#c4693f]" min="100"
                            max="2000" step="50" value="{{ request('max_price', 2000) }}"
                            oninput="document.getElementById('priceLabel').innerText = '₱' + this.value">
                        <div class="flex justify-between text-sm mt-1">
                            <span>₱100</span>
                            <span>₱2,000</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#c4693f] text-white py-2 rounded-xl text-sm font-medium hover:bg-[#a85230] transition">
                        Apply Filters
                    </button>

                    @if(request()->hasAny(['search', 'category', 'max_price', 'sort']))
                        <a href="{{ route('shop') }}"
                            class="block text-center mt-3 text-sm text-[#9d7d6a] hover:text-[#c4693f]">
                            Clear all filters
                        </a>
                    @endif
                </form>
            </div>

            <!-- Main Content -->
            <div class="flex-1">

                <!-- Sort & Results -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-[#6b5d52]">
                        Showing <span class="font-medium text-[#2e1a0e]">{{ $products->total() }}</span> products
                    </p>
                    <form method="GET" action="{{ route('shop') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                        <select name="sort" onchange="this.form.submit()"
                            class="border border-[#e8d5bd] rounded-xl px-4 py-2 text-sm">
                            <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Sort by Popularity</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First
                            </option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to
                                High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High
                                to Low</option>
                        </select>
                    </form>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6" id="productGrid">

                    @forelse($products as $product)
                        <div class="product-card bg-white rounded-2xl overflow-hidden border border-[#e8d5bd]">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="product-img w-full h-52 object-cover" alt="{{ $product->name }}">
                                @if($product->is_featured)
                                    <span
                                        class="absolute top-3 left-3 bg-[#c4693f] text-white text-xs font-medium px-3 py-1 rounded-full shadow">
                                        Featured
                                    </span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h5 class="font-medium text-[#2e1a0e] line-clamp-2 h-12">{{ $product->name }}</h5>
                                <p class="text-[#c4693f] text-xl font-bold price mt-2">
                                    ₱{{ number_format($product->price, 2) }}</p>

                                @if($product->stock <= 0)
                                    <p class="text-xs text-red-500 font-semibold mt-1">Out of Stock</p>
                                    <button disabled
                                        class="mt-4 w-full bg-gray-300 text-gray-500 py-2.5 rounded-xl text-sm font-medium cursor-not-allowed">
                                        Out of Stock
                                    </button>
                                @else
                                    <p class="text-xs text-[#9d7d6a] mt-1">Stock: {{ $product->stock }}</p>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="mt-4 w-full bg-[#c4693f] hover:bg-[#9e4a28] text-white py-2.5 rounded-xl text-sm font-medium transition">
                                            Add to Cart
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-20">
                            <p class="text-[#9d7d6a] text-lg">No products found.</p>
                            <a href="{{ route('shop') }}"
                                class="text-[#c4693f] text-sm mt-2 inline-block hover:underline">Clear filters</a>
                        </div>
                    @endforelse

                </div>
                <!-- Load More -->
    <div class="text-center mt-12" id="loadMoreContainer">
        @if($products->hasMorePages())
            <button onclick="loadMore()" id="loadMoreBtn"
                class="px-10 py-3 border-2 border-[#c4693f] text-[#c4693f] font-medium rounded-2xl hover:bg-[#c4693f] hover:text-white transition">
                Load More Products
            </button>
        @endif
    </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->withQueryString()->links() }}
                </div>

            </div>
        </div>
    </div>
    

    <script>
        function addToCart(btn) {
            btn.innerHTML = '✅ Added!';
            btn.style.background = '#4ade80';
            setTimeout(() => {
                btn.innerHTML = 'Add to Cart';
                btn.style.background = '';
            }, 1500);
        }
        let currentPage = {{ $products->currentPage() }};
        const lastPage = {{ $products->lastPage() }};
        let searchTimer = null;

        // ── SEARCH (real-time) ──
        document.getElementById('searchInput').addEventListener('input', function () {
            clearTimeout(searchTimer);
            const spinner = document.getElementById('searchSpinner');
            spinner.classList.remove('hidden');

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
                        spinner.classList.add('hidden');
                        document.getElementById('productGrid').innerHTML = data.html;
                        document.getElementById('resultCount').innerText = data.total;
                        currentPage = 1;

                        // update load more
                        const container = document.getElementById('loadMoreContainer');
                        if (data.last_page > 1) {
                            container.innerHTML = `
                        <button onclick="loadMore()"
                            id="loadMoreBtn"
                            class="px-10 py-3 border-2 border-[#c4693f] text-[#c4693f] font-medium rounded-2xl hover:bg-[#c4693f] hover:text-white transition">
                            Load More Products
                        </button>`;
                        } else {
                            container.innerHTML = '';
                        }

                        // update URL without reload
                        const newUrl = '{{ route('shop') }}?' + new URLSearchParams(
                            Object.fromEntries(params.entries())
                        ).toString();
                        window.history.pushState({}, '', newUrl.replace('&ajax=1', '').replace('?ajax=1', ''));
                    })
                    .catch(() => spinner.classList.add('hidden'));
            }, 400); // 400ms debounce
        });

        // ── LOAD MORE ──
        function loadMore() {
            const btn = document.getElementById('loadMoreBtn');
            btn.innerText = 'Loading...';
            btn.disabled = true;

            const params = new URLSearchParams(window.location.search);
            params.set('page', currentPage + 1);
            params.set('ajax', '1');

            fetch('{{ route('shop') }}?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(r => r.json())
                .then(data => {
                    document.getElementById('productGrid').insertAdjacentHTML('beforeend', data.html);
                    currentPage++;

                    if (currentPage >= data.last_page) {
                        document.getElementById('loadMoreContainer').innerHTML =
                            '<p class="text-[#9d7d6a] text-sm">You\'ve seen all products.</p>';
                    } else {
                        btn.innerText = 'Load More Products';
                        btn.disabled = false;
                    }
                })
                .catch(() => {
                    btn.innerText = 'Load More Products';
                    btn.disabled = false;
                });
        }

    </script>

</x-app-layout>