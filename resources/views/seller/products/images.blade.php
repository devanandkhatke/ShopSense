@extends('layouts.seller')

@section('title', 'Product Images')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Images for: {{ $product->name }}
</h1>

@if(session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<form method="POST"
    action="{{ route('seller.products.images.store', $product) }}"
    enctype="multipart/form-data"
    class="bg-white p-4 rounded shadow mb-6">
    @csrf

    <input type="file" name="image" required>
    <button class="bg-black text-white px-4 py-2 rounded ml-2">
        Upload Image
    </button>
</form>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach($product->images as $image)
    <div class="border p-2 rounded">
        <img src="{{ asset('storage/'.$image->path) }}"
            class="w-full h-32 object-cover rounded">

        <form method="POST"
            action="{{ route('seller.products.images.destroy', $image) }}"
            class="mt-2">
            @csrf
            @method('DELETE')

            <button class="text-red-600 text-sm">
                Delete
            </button>
        </form>
    </div>
    @endforeach
</div>

@endsection