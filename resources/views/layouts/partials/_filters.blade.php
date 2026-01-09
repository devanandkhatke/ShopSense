<form method="GET" action="{{ route('shop.index') }}"
    class="flex flex-wrap gap-4 items-end">

    {{-- Category --}}
    <div>
        <label class="block text-sm font-medium mb-1">Category</label>
        <select name="category" class="border rounded px-3 py-2">
            <option value="">All</option>
            <option value="electronics">Electronics</option>
            <option value="fashion">Fashion</option>
        </select>
    </div>

    {{-- Min Price --}}
    <div>
        <label class="block text-sm font-medium mb-1">Min Price</label>
        <input type="number" name="min_price"
            class="border rounded px-3 py-2 w-32"
            value="{{ request('min_price') }}">
    </div>

    {{-- Max Price --}}
    <div>
        <label class="block text-sm font-medium mb-1">Max Price</label>
        <input type="number" name="max_price"
            class="border rounded px-3 py-2 w-32"
            value="{{ request('max_price') }}">
    </div>

    {{-- Sort --}}
    <div>
        <label class="block text-sm font-medium mb-1">Sort</label>
        <select name="sort" class="border rounded px-3 py-2">
            <option value="">Default</option>
            <option value="price_asc">Price: Low → High</option>
            <option value="price_desc">Price: High → Low</option>
        </select>
    </div>

    {{-- Submit --}}
    <div>
        <button
            class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
            Apply
        </button>
    </div>

</form>