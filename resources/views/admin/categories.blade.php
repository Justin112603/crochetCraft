<x-app-layout>

    <style>
        .category-row:hover {
            background-color: #fffaf0;
        }

        .icon-circle {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: #f8f1e9;
            border-radius: 50%;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 24px;
            width: 100%;
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
        }
    </style>

    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#2e1a0e]">Categories Management</h1>
                <p class="text-[#9d7d6a]">Manage your product categories</p>
            </div>
            <button onclick="showCreateModal()"
                class="bg-[#c4693f] hover:bg-[#9e4a28] text-white px-6 py-3 rounded-2xl flex items-center gap-2 transition">
                <span class="text-xl">+</span> New Category
            </button>
        </div>

        @if(session('success'))
            <div id="success-message"
                class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-2xl mb-6 transition-opacity duration-500">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(() => {
                    const msg = document.getElementById('success-message');

                    if (msg) {
                        msg.style.opacity = '0';

                        setTimeout(() => {
                            msg.remove();
                        }, 500);
                    }
                }, 5000);
            </script>
        @endif
        @if(session('error'))
            <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-2xl mb-6">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(() => {
                    const msg = document.getElementById('error-message');

                    if (msg) {
                        msg.style.transition = '0.5s';
                        msg.style.opacity = '0';

                        setTimeout(() => msg.remove(), 500);
                    }
                }, 5000);
            </script>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-3xl shadow overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="px-6 py-5 text-left text-sm font-medium text-[#9d7d6a]">Icon</th>
                        <th class="px-6 py-5 text-left text-sm font-medium text-[#9d7d6a]">Category Name</th>
                        <th class="px-6 py-5 text-left text-sm font-medium text-[#9d7d6a]">Slug</th>
                        <th class="px-6 py-5 text-left text-sm font-medium text-[#9d7d6a]">Description</th>
                        <th class="px-6 py-5 text-center text-sm font-medium text-[#9d7d6a]">Status</th>
                        <th class="px-6 py-5 text-center text-sm font-medium text-[#9d7d6a]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="category-row border-b last:border-none hover:bg-[#fffaf0]">
                            <td class="px-6 py-5">
                                <div class="icon-circle">{{ $category->icon ?? '🧶' }}</div>
                            </td>
                            <td class="px-6 py-5 font-medium text-[#2e1a0e]">{{ $category->name }}</td>
                            <td class="px-6 py-5 text-[#9d7d6a] font-mono text-sm">{{ $category->slug }}</td>
                            <td class="px-6 py-5 text-sm text-[#6b5d52]">{{ Str::limit($category->description, 60) }}</td>
                            <td class="px-6 py-5 text-center">
                                @if($category->is_active)
                                    <span
                                        class="px-4 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Active</span>
                                @else
                                    <span
                                        class="px-4 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-center">
                                <button
    onclick="openEditModal(
        '{{ $category->id }}',
        '{{ $category->name }}',
        '{{ $category->slug }}',
        '{{ $category->icon }}',
        `{{ $category->description }}`,
        '{{ $category->is_active }}'
    )"
    class="text-blue-600 hover:text-blue-800 mr-4">
    Edit
</button>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Delete this category?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-[#9d7d6a]">No categories yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            @if($categories instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $categories->links() }}
            @else
                <p class="text-gray-500">Pagination not available</p>
            @endif
        </div>
    </div>

    <!-- ==================== CREATE CATEGORY MODAL ==================== -->
    <div id="createModal" class="modal">
        <div class="modal-content">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-[#2e1a0e] mb-6">Create New Category</h2>

                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium mb-2">Category Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="modal_name"
                                class="w-full px-4 py-3 border border-[#e8d5bd] rounded-2xl focus:border-[#c4693f]"
                                required onkeyup="generateSlugModal()">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Slug</label>
                            <input type="text" name="slug" id="modal_slug"
                                class="w-full px-4 py-3 border border-[#e8d5bd] rounded-2xl bg-gray-50" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Icon (Emoji)</label>
                            <input type="text" name="icon" value="🧶"
                                class="w-full px-4 py-3 border border-[#e8d5bd] rounded-2xl text-2xl">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Description</label>
                            <textarea name="description" rows="3"
                                class="w-full px-4 py-3 border border-[#e8d5bd] rounded-2xl"></textarea>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_active" checked>
                            <span class="text-sm">Active (Show to customers)</span>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-8">
                        <button type="button" onclick="hideCreateModal()"
                            class="flex-1 py-4 border border-gray-300 rounded-2xl font-medium">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 bg-[#c4693f] hover:bg-[#9e4a28] text-white py-4 rounded-2xl font-medium">
                            Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ==================== EDIT CATEGORY MODAL ==================== -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="p-8">

            <h2 class="text-2xl font-bold text-[#2e1a0e] mb-6">
                Edit Category
            </h2>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-5">

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Category Name
                        </label>

                        <input type="text"
                               name="name"
                               id="edit_name"
                               class="w-full px-4 py-3 border border-[#e8d5bd] rounded-2xl"
                               required
                               onkeyup="generateEditSlug()">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Slug
                        </label>

                        <input type="text"
                               name="slug"
                               id="edit_slug"
                               readonly
                               class="w-full px-4 py-3 border border-[#e8d5bd] rounded-2xl bg-gray-50">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Icon
                        </label>

                        <input type="text"
                               name="icon"
                               id="edit_icon"
                               class="w-full px-4 py-3 border border-[#e8d5bd] rounded-2xl text-2xl">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Description
                        </label>

                        <textarea name="description"
                                  id="edit_description"
                                  rows="3"
                                  class="w-full px-4 py-3 border border-[#e8d5bd] rounded-2xl"></textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox"
                               name="is_active"
                               id="edit_active">

                        <span class="text-sm">
                            Active
                        </span>
                    </div>

                </div>

                <div class="flex gap-4 mt-8">

                    <button type="button"
                            onclick="hideEditModal()"
                            class="flex-1 py-4 border border-gray-300 rounded-2xl font-medium">
                        Cancel
                    </button>

                    <button type="submit"
                            class="flex-1 bg-[#c4693f] hover:bg-[#9e4a28] text-white py-4 rounded-2xl font-medium">
                        Update Category
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


    <script>
        function showCreateModal() {
            document.getElementById('createModal').style.display = 'flex';
        }

        function hideCreateModal() {
            document.getElementById('createModal').style.display = 'none';
        }

        function generateSlugModal() {
            let name = document.getElementById('modal_name').value;
            let slug = name.toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('modal_slug').value = slug;
        }

        // Close modal when clicking outside
        window.onclick = function (e) {
            const modal = document.getElementById('createModal');
            if (e.target === modal) hideCreateModal();
        }

        function openEditModal(id, name, slug, icon, description, active) {

    document.getElementById('edit_name').value = name;
    document.getElementById('edit_slug').value = slug;
    document.getElementById('edit_icon').value = icon;
    document.getElementById('edit_description').value = description;

    document.getElementById('edit_active').checked =
        active == 1;

    document.getElementById('editForm').action =
        `/admin/categories/${id}`;

    document.getElementById('editModal').style.display = 'flex';
}

function hideEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function generateEditSlug() {

    let name = document.getElementById('edit_name').value;

    let slug = name.toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');

    document.getElementById('edit_slug').value = slug;
}
    </script>

</x-app-layout>