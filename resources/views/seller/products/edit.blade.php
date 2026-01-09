@extends('layouts.seller')

@section('title', 'Edit Product')

@section('content')

<h1 class="text-2xl font-bold mb-6">Edit Product</h1>

<form method="POST"
    action="{{ route('seller.products.update', $product) }}"
    class="bg-white p-6 rounded shadow max-w-3xl">
    @csrf
    @method('PUT')

    <label class="block font-semibold mb-1">Product Name</label>
    <input type="text" name="name" value="{{ $product->name }}"
        class="w-full border rounded p-2 mb-4" required>

    <label class="block font-semibold mb-1">Price</label>
    <input type="number" step="0.01" name="price"
        value="{{ $product->price }}"
        class="w-full border rounded p-2 mb-4" required>

    <label class="block font-semibold mb-1">Stock</label>
    <input type="number" name="stock"
        value="{{ $product->stock }}"
        class="w-full border rounded p-2 mb-4" required>

    <label class="block font-semibold mb-1">Description</label>
    <textarea name="description"
        class="w-full border rounded p-2 mb-4"
        rows="4">{{ $product->description }}</textarea>

    <button class="bg-black text-white px-6 py-2 rounded">
        Update Product
    </button>
</form>

@endsection