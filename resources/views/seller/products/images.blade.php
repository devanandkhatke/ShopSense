@extends('layouts.seller')

@section('title', 'Product Images')

@section('content')

<h1 class="text-2xl font-bold mb-6">Product Images</h1>

<form method="POST"
    action="{{ route('seller.products.images.store', $product) }}"
    enctype="multipart/form-data"
    class="bg-white p-4 rounded shadow max-w-md">
    @csrf

    <input type="file" name="image" required>
    <button class="mt-3 bg-black text-white px-4 py-2 rounded">
        Upload Image
    </button>
</form>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
    @foreach($product->images as $image)
    <div class="bg-white p-2 rounded shadow">
        <img src="{{ asset('storage/'.$image->path) }}"
            class="h-32 w-full object-cover rounded">

        <form method="POST"
            action="{{ route('seller.products.images.destroy', $image) }}">
            @csrf
            @method('DELETE')

            <button class="text-red-600 text-sm mt-2">
                Delete
            </button>
        </form>
    </div>
    @endforeach
</div>

@endsection