<div class="bg-white rounded shadow p-4">

    <h2 class="font-semibold mb-4">Filters</h2>

    {{-- CATEGORY FILTER --}}
    <div class="mb-4">
        <label class="block text-sm font-semibold mb-1">Category</label>
        <select class="w-full border rounded p-2">
            <option>All Categories</option>
        </select>
    </div>

    {{-- PRICE FILTER --}}
    <div class="mb-4">
        <label class="block text-sm font-semibold mb-1">Max Price</label>
        <input type="number" class="w-full border rounded p-2" placeholder="₹">
    </div>

    <button class="bg-black text-white px-4 py-2 rounded w-full">
        Apply Filters
    </button>

</div>