@extends('layouts.seller')

@section('title', 'Create Product')

@section('content')

<h1 class="text-2xl font-bold mb-6">Create Product</h1>

<form method="POST"
    action="{{ route('seller.products.store') }}"
    class="bg-white p-6 rounded shadow max-w-3xl">
    @csrf

    {{-- BASIC INFO --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="block font-semibold mb-1">Product Name</label>
            <input type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border rounded p-2"
                required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Category</label>
            <select name="category_id"
                id="category"
                class="w-full border rounded p-2"
                required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id')==$category->id)>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="mt-4">
        <label class="block font-semibold mb-1">Description</label>
        <textarea name="description"
            rows="3"
            class="w-full border rounded p-2">{{ old('description') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
        <div>
            <label class="block font-semibold mb-1">Base Price</label>
            <input type="number"
                step="0.01"
                name="price"
                value="{{ old('price') }}"
                class="w-full border rounded p-2"
                required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Base Stock</label>
            <input type="number"
                name="stock"
                value="{{ old('stock', 0) }}"
                class="w-full border rounded p-2"
                required>
        </div>
    </div>

    {{-- ATTRIBUTES --}}
    <hr class="my-6">

    <h2 class="text-lg font-semibold mb-3">Product Attributes</h2>

    @foreach($categories as $category)
    <div class="category-attributes space-y-4"
        data-category="{{ $category->id }}"
        style="display:none">

        @forelse($category->attributes as $attribute)
        <div>
            <label class="block font-semibold mb-1">
                {{ $attribute->name }}
            </label>

            <select name="attributes[{{ $attribute->id }}]"
                class="attribute-select w-full border rounded p-2">
                <option value="">-- Select {{ $attribute->name }} --</option>

                @foreach($attribute->values as $value)
                <option value="{{ $value->id }}"
                    @selected(old('attributes.'.$attribute->id) == $value->id)>
                    {{ $value->value }}
                </option>
                @endforeach
            </select>
        </div>
        @empty
        <p class="text-sm text-gray-500">
            No attributes for this category.
        </p>
        @endforelse

    </div>
    @endforeach

    {{-- SUBMIT --}}
    <div class="mt-8">
        <button type="submit"
            class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
            Save Product
        </button>

        <a href="{{ route('seller.products.index') }}"
            class="ml-4 text-gray-600 hover:underline">
            Cancel
        </a>
    </div>

</form>

{{-- CATEGORY → ATTRIBUTE TOGGLE --}}
<script>
    const categorySelect = document.getElementById('category');
    const attributeBlocks = document.querySelectorAll('.category-attributes');

    function toggleAttributes() {
        attributeBlocks.forEach(block => block.style.display = 'none');

        if (categorySelect.value) {
            const active = document.querySelector(
                `[data-category="${categorySelect.value}"]`
            );
            if (active) active.style.display = 'block';
        }
    }

    categorySelect.addEventListener('change', toggleAttributes);
    toggleAttributes();
</script>

@endsection