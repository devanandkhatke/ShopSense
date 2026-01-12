@extends('layouts.seller')

@section('title', 'Product Details')

@section('content')

<h1 class="text-2xl font-bold mb-6">{{ $product->name }}</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Images --}}
    <div>
        @if($product->images->count())
        <img src="{{ asset('storage/'.$product->images->first()->path) }}"
            class="w-full h-80 object-cover rounded">
        @else
        <div class="h-80 bg-gray-100 flex items-center justify-center">
            No Images
        </div>
        @endif
    </div>

    {{-- Info --}}
    <div>
        <p><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
        <p><strong>Status:</strong> {{ ucfirst($product->status) }}</p>

        <div class="mt-4">
            <strong>Attributes:</strong>
            <div class="mt-2 space-x-2">
                @foreach($product->attributeValues as $value)
                <span class="inline-block bg-gray-200 px-2 py-1 rounded text-sm">
                    {{ $value->attribute->name }}: {{ $value->value }}
                </span>
                @endforeach
            </div>
        </div>

        <div class="mt-6 space-x-3">
            <a href="{{ route('seller.products.edit', $product) }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded">
                Edit
            </a>

            <a href="{{ route('seller.products.images.index', $product) }}"
                class="bg-gray-800 text-white px-4 py-2 rounded">
                Images
            </a>

        </div>
    </div>

</div>

@endsection