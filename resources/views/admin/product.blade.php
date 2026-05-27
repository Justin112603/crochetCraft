<x-app-layout>

<style>

    .success-message{
        background:#e6f9ed;
        color:#166534;
        padding:12px;
        border-radius:10px;
        margin-bottom:15px;
    }

    .error-message{
        background:#fde8e8;
        color:#9b1c1c;
        padding:12px;
        border-radius:10px;
        margin-bottom:15px;
    }

    .modal{
        display:none;
        position:fixed;
        z-index:9999;
        left:0;
        top:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.6);

        align-items:center;
        justify-content:center;

        padding:20px;
    }

    .modal-content{
        background:white;
        width:100%;
        max-width:700px;
        border-radius:28px;

        animation:modalFade .25s ease;
    }

    @keyframes modalFade{

        from{
            opacity:0;
            transform:scale(.95);
        }

        to{
            opacity:1;
            transform:scale(1);
        }
    }

</style>

<div class="max-w-7xl mx-auto px-6 py-8">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-[#2e1a0e]">
                Product Management
            </h1>

            <p class="text-[#9d7d6a]">
                Add and manage products
            </p>

        </div>

    </div>

    {{-- SUCCESS --}}
    @if(session('success'))

        <div id="success-message"
             class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-2xl mb-6">

            {{ session('success') }}

        </div>

    @endif

    {{-- ERROR --}}
    @if(session('error'))

        <div id="error-message"
             class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-2xl mb-6">

            {{ session('error') }}

        </div>

    @endif

    <!-- ADD PRODUCT FORM -->
    <div class="bg-white rounded-3xl shadow p-8 mb-8">

        <form action="{{ route('admin.product.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="block mb-2 font-medium">
                        Product Name
                    </label>

                    <input type="text"
                           name="name"
                           class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3">

                </div>

                <div>

                    <label class="block mb-2 font-medium">
                        Category
                    </label>

                    <select name="category_id"
                            class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3">

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}">
                                {{ $category->icon }} {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="block mb-2 font-medium">
                        Price
                    </label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3">

                </div>

                <div>

                    <label class="block mb-2 font-medium">
                        Stock
                    </label>

                    <input type="number"
                           name="stock"
                           class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3">

                </div>

                <div class="md:col-span-2">

                    <label class="block mb-2 font-medium">
                        Description
                    </label>

                    <textarea name="description"
                              rows="4"
                              class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3"></textarea>

                </div>

                <div>

                    <label class="block mb-2 font-medium">
                        Product Image
                    </label>

                    <input type="file"
                           name="image"
                           class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3">

                </div>

                <div class="flex items-center gap-6 mt-8">

                    <label class="flex items-center gap-2">

                        <input type="checkbox" name="is_featured">

                        Featured

                    </label>

                    <label class="flex items-center gap-2">

                        <input type="checkbox"
                               name="is_active"
                               checked>

                        Active

                    </label>

                </div>

            </div>

            <button type="submit"
                    class="mt-8 bg-[#c4693f] hover:bg-[#9e4a28] text-white px-8 py-4 rounded-2xl font-medium transition">

                Add Product

            </button>

        </form>

    </div>

    <!-- PRODUCT LIST -->
    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <div class="p-6 border-b">

            <h2 class="text-2xl font-bold text-[#2e1a0e]">
                Available Products
            </h2>

        </div>

        <table class="w-full">

            <thead class="bg-[#fff7f2]">

                <tr>

                    <th class="px-6 py-4 text-left">Image</th>
                    <th class="px-6 py-4 text-left">Product</th>
                    <th class="px-6 py-4 text-left">Category</th>
                    <th class="px-6 py-4 text-left">Price</th>
                    <th class="px-6 py-4 text-left">Stock</th>
                    <th class="px-6 py-4 text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($products as $product)

                    <tr class="border-b hover:bg-[#fffaf5]">

                        <td class="px-6 py-4">

                            @if($product->image)

                                <img src="{{ asset('storage/' . $product->image) }}"
                                     class="w-16 h-16 object-cover rounded-2xl">

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            <h3 class="font-semibold text-[#2e1a0e]">
                                {{ $product->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ Str::limit($product->description, 40) }}
                            </p>

                        </td>

                        <td class="px-6 py-4">
                            {{ $product->category->name ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4 font-medium text-[#c4693f]">
                            ₱{{ number_format($product->price, 2) }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $product->stock }}
                        </td>

                        <td class="px-6 py-4 text-center">

                            <button
                                type="button"
                                onclick='openEditProductModal(
                                    @json($product->id),
                                    @json($product->name),
                                    @json($product->category_id),
                                    @json($product->price),
                                    @json($product->stock),
                                    @json($product->description)
                                )'
                                class="text-blue-600 hover:text-blue-800 mr-4">

                                Edit

                            </button>

                            <form action="{{ route('admin.product.destroy', $product) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Delete this product?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-600 hover:text-red-800">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-10 text-gray-500">

                            No products available.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="p-6">
            {{ $products->links() }}
        </div>

    </div>

</div>

<!-- EDIT PRODUCT MODAL -->
<div id="editProductModal" class="modal">

    <div class="modal-content">

        <div class="p-8">

            <h2 class="text-2xl font-bold mb-6 text-[#2e1a0e]">
                Edit Product
            </h2>

            <form id="editProductForm"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-2 font-medium">
                            Product Name
                        </label>

                        <input type="text"
                               name="name"
                               id="edit_product_name"
                               class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3">

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Category
                        </label>

                        <select name="category_id"
                                id="edit_product_category"
                                class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3">

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Price
                        </label>

                        <input type="number"
                               step="0.01"
                               name="price"
                               id="edit_product_price"
                               class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3">

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Stock
                        </label>

                        <input type="number"
                               name="stock"
                               id="edit_product_stock"
                               class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3">

                    </div>

                    <div class="md:col-span-2">

                        <label class="block mb-2 font-medium">
                            Description
                        </label>

                        <textarea name="description"
                                  id="edit_product_description"
                                  rows="4"
                                  class="w-full border border-[#e8d5bd] rounded-2xl px-4 py-3"></textarea>

                    </div>

                </div>

                <div class="flex gap-4 mt-8">

                    <button type="button"
                            onclick="hideEditProductModal()"
                            class="flex-1 border py-4 rounded-2xl">

                        Cancel

                    </button>

                    <button type="submit"
                            class="flex-1 bg-[#c4693f] hover:bg-[#9e4a28] text-white py-4 rounded-2xl">

                        Update Product

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

    // AUTO HIDE ALERTS

    setTimeout(() => {

        const success =
            document.getElementById('success-message');

        if(success){

            success.style.transition = '0.5s';
            success.style.opacity = '0';

            setTimeout(() => {
                success.remove();
            }, 500);
        }

        const error =
            document.getElementById('error-message');

        if(error){

            error.style.transition = '0.5s';
            error.style.opacity = '0';

            setTimeout(() => {
                error.remove();
            }, 500);
        }

    }, 5000);

    // OPEN MODAL

    function openEditProductModal(
        id,
        name,
        category,
        price,
        stock,
        description
    ){

        document.getElementById('edit_product_name').value =
            name || '';

        document.getElementById('edit_product_category').value =
            category || '';

        document.getElementById('edit_product_price').value =
            price || '';

        document.getElementById('edit_product_stock').value =
            stock || '';

        document.getElementById('edit_product_description').value =
            description || '';

        document.getElementById('editProductForm').action =
            `/admin/products/${id}`;

        document.getElementById('editProductModal').style.display =
            'flex';
    }

    // CLOSE MODAL

    function hideEditProductModal(){

        document.getElementById('editProductModal').style.display =
            'none';
    }

    // CLOSE OUTSIDE

    window.onclick = function(e){

        const modal =
            document.getElementById('editProductModal');

        if(e.target === modal){

            hideEditProductModal();
        }
    }

</script>

</x-app-layout>