@extends('layouts.seller')

@section('title', 'Product Variants')

@section('content')

<h1 class="text-2xl font-bold mb-4">
    Variants – {{ $product->name }}
</h1>

{{-- Existing Variants --}}
<table class="w-full bg-white shadow rounded mb-8">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-3">Attributes</th>
            <th class="p-3">Price</th>
            <th class="p-3">Stock</th>
            <th class="p-3">SKU</th>
        </tr>
    </thead>
    <tbody>
        @foreach($product->variants as $variant)
        <tr class="border-t">
            <td class="p-3">
                @foreach($variant->attributeValues as $value)
                <span class="inline-block bg-gray-200 px-2 py-1 rounded text-sm mr-1">
                    {{ $value->attribute->name }}: {{ $value->value }}
                </span>
                @endforeach
            </td>
            <td class="p-3">₹{{ $variant->price }}</td>
            <td class="p-3">{{ $variant->stock }}</td>
            <td class="p-3">{{ $variant->sku }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Create Variant --}}
<h2 class="text-lg font-semibold mb-2">Add Variant</h2>

<form method="POST" action="{{ route('seller.variants.store', $product) }}"
    class="bg-white p-6 rounded shadow max-w-xl">
    @csrf

    @foreach($product->attributeValues->groupBy('attribute_id') as $group)
    <label class="block font-semibold mt-3">
        {{ $group->first()->attribute->name }}
    </label>
    <select name="attributes[]" class="w-full border p-2 rounded" required>
        @foreach($group as $value)
        <option value="{{ $value->id }}">{{ $value->value }}</option>
        @endforeach
    </select>
    @endforeach

    <label class="block font-semibold mt-4">Price</label>
    <input type="number" name="price" class="w-full border p-2 rounded" required>

    <label class="block font-semibold mt-4">Stock</label>
    <input type="number" name="stock" class="w-full border p-2 rounded" required>

    <button class="mt-4 bg-black text-white px-4 py-2 rounded">
        Create Variant
    </button>

</form>

@endsection