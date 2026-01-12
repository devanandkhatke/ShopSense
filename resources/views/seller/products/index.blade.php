@extends('layouts.seller')

@section('title', 'My Products')

@section('content')

<h1 class="text-2xl font-bold mb-6">My Products</h1>

<a href="{{ route('seller.products.create') }}"
    class="bg-black text-white px-4 py-2 rounded mb-4 inline-block">
    + Add Product
</a>

<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Product</th>
            <th class="p-3">Price</th>
            <th class="p-3">Stock</th>
            <th class="p-3">Status</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr class="border-t">
            <td class="p-3 font-semibold">{{ $product->name }}</td>
            <td class="p-3">₹{{ number_format($product->price, 2) }}</td>
            <td class="p-3">{{ $product->stock }}</td>
            <td class="p-3 capitalize">{{ $product->status }}</td>
            <td class="p-3 space-x-3">
                <a href="{{ route('seller.products.show', $product) }}"
                    class="text-blue-600 hover:underline">View</a>
                <a href="{{ route('seller.products.edit', $product) }}"
                    class="text-yellow-600 hover:underline">Edit</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="p-4 text-center text-gray-500">
                No products found.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection