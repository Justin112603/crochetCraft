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

        .category-chip.active,
        .category-chip:hover {
            background: var(--terra);
            color: white;
            transform: translateY(-2px);
        }

        .price {
            font-family: 'Cormorant Garamond', serif;
        }
    </style>

    <div class="bg-[#f8f1e9] min-h-screen">

        <!-- Top Search & Nav -->
        <div class=" border-b sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="flex items-center gap-4">
                    <a href="/" class="text-2xl font-bold text-[#2e1a0e]">CrochetCraft</a>

                    <div class="flex-1 max-w-2xl">
                        <div class="relative">
                            <input type="text" id="searchInput"
                                class="w-full border border-[#e8d5bd] rounded-full py-3 px-5 pl-12 focus:outline-none focus:border-[#c4693f]"
                                placeholder="Search handmade crochet items...">
                            <span class="absolute left-5 top-3.5 text-gray-400">🔍</span>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- Category Chips -->
        <div class="max-w-7xl mx-auto px-4 py-6 border-b">
            <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">

                <!-- ALL BUTTON -->
                <button onclick="filterCategory('all', this)"
                    class="category-chip active whitespace-nowrap px-6 py-2.5 rounded-3xl text-sm font-medium bg-[#c4693f] text-white border border-[#c4693f]">
                    All
                </button>

                <!-- DATABASE CATEGORIES -->
                @foreach($categories as $category)
                    <button onclick="filterCategory('{{ $category->slug }}', this)"
                        class="category-chip whitespace-nowrap px-6 py-2.5 rounded-3xl text-sm font-medium border border-[#e8d5bd] text-[#5d4030] hover:bg-[#c4693f] hover:text-white transition">

                        {{ $category->icon }} {{ $category->name }}
                    </button>
                @endforeach

            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-8 flex gap-8">

            <!-- Sidebar Filters -->
            <div class="w-64 hidden lg:block">
                <h3 class="font-semibold mb-4 text-[#2e1a0e]">Filters</h3>

                <div class="mb-6">
                    <p class="text-sm font-medium mb-3">Price Range</p>
                    <input type="range" class="w-full accent-[#c4693f]">
                    <div class="flex justify-between text-sm mt-1">
                        <span>₱100</span>
                        <span>₱2,000</span>
                    </div>
                </div>


            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Sort & Results -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-[#6b5d52]">Showing <span class="font-medium text-[#2e1a0e]">124</span> products</p>
                    <select class="border border-[#e8d5bd] rounded-xl px-4 py-2 text-sm">
                        <option>Sort by Popularity</option>
                        <option>Newest First</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
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

                                <h5 class="font-medium text-[#2e1a0e] line-clamp-2 h-12">
                                    {{ $product->name }}
                                </h5>

                                <p class="text-[#c4693f] text-xl font-bold price mt-2">
                                    ₱{{ number_format($product->price, 2) }}
                                </p>

                                @if($product->stock <= 0)

    <p class="text-xs text-red-500 font-semibold mt-1">
        Out of Stock
    </p>

    <button disabled
        class="mt-4 w-full bg-gray-300 text-gray-500 py-2.5 rounded-xl text-sm font-medium cursor-not-allowed">

        Out of Stock
    </button>

@else

    <p class="text-xs text-[#9d7d6a] mt-1">
        Stock: {{ $product->stock }}
    </p>

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
                            <p class="text-[#9d7d6a] text-lg">
                                No products available.
                            </p>
                        </div>

                    @endforelse

                </div>

                <!-- Load More -->
                <div class="text-center mt-12">
                    <button onclick="loadMore()"
                        class="px-10 py-3 border-2 border-[#c4693f] text-[#c4693f] font-medium rounded-2xl hover:bg-[#c4693f] hover:text-white transition">
                        Load More Products
                    </button>
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

        function filterCategory(el) {
            document.querySelectorAll('.category-chip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
        }

        function loadMore() {
            alert("In real app this would load more products via AJAX");
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function (e) {
            if (e.key === 'Enter') {
                alert('Searching for: ' + this.value);
            }
        });
    </script>

</x-app-layout>