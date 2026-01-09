@extends('layouts.admin')

@section('title', 'All Products')

@section('content')

<h1 class="text-2xl font-bold mb-6">All Products</h1>

{{-- FILTERS --}}
<form method="GET" class="bg-white p-4 rounded shadow mb-6 grid grid-cols-1 md:grid-cols-5 gap-4">

    <select name="status" class="border p-2 rounded">
        <option value="">All Status</option>
        @foreach(['pending','approved','rejected'] as $status)
        <option value="{{ $status }}" @selected(request('status')==$status)>
            {{ ucfirst($status) }}
        </option>
        @endforeach
    </select>

    <select name="category_id" class="border p-2 rounded">
        <option value="">All Categories</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}"
            @selected(request('category_id')==$category->id)>
            {{ $category->name }}
        </option>
        @endforeach
    </select>

    <select name="seller_id" class="border p-2 rounded">
        <option value="">All Sellers</option>
        @foreach($sellers as $seller)
        <option value="{{ $seller->id }}"
            @selected(request('seller_id')==$seller->id)>
            {{ $seller->name }}
        </option>
        @endforeach
    </select>

    <input type="number" name="min_price" placeholder="Min Price"
        value="{{ request('min_price') }}" class="border p-2 rounded">

    <input type="number" name="max_price" placeholder="Max Price"
        value="{{ request('max_price') }}" class="border p-2 rounded">

    <button class="bg-black text-white px-4 py-2 rounded col-span-full">
        Apply Filters
    </button>
</form>

{{-- PRODUCT TABLE --}}
<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3">ID</th>
            <th class="p-3 text-left">Product</th>
            <th class="p-3">Category</th>
            <th class="p-3">Seller</th>
            <th class="p-3">Price</th>
            <th class="p-3">Stock</th>
            <th class="p-3">Status</th>
            <th class="p-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr class="border-t">
            <td class="p-3">{{ $product->id }}</td>
            <td class="p-3">
                <a href="{{ route('admin.products.show', $product) }}"
                    class="text-blue-600 hover:underline font-medium">
                    {{ $product->name }}
                </a>
            </td>
            <td class="p-3">{{ $product->category->name ?? '-' }}</td>
            <td class="p-3">{{ $product->seller->name ?? '-' }}</td>
            <td class="p-3">₹{{ number_format($product->price, 2) }}</td>
            <td class="p-3">{{ $product->stock }}</td>
            <td class="p-3 capitalize">{{ $product->status }}</td>
            <td class="p-3 space-x-2">
                @if($product->status !== 'approved')
                <form method="POST" action="{{ route('admin.products.approve', $product) }}" class="inline">
                    @csrf
                    <button class="text-green-600">Approve</button>
                </form>
                @endif

                @if($product->status !== 'rejected')
                <form method="POST" action="{{ route('admin.products.reject', $product) }}" class="inline">
                    @csrf
                    <button class="text-red-600">Reject</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="p-6 text-center text-gray-500">
                No products found
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-6">
    {{ $products->links() }}
</div>

@endsection