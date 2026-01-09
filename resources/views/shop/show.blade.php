@extends('layouts.app')

@section('title', $product->name)

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    {{-- IMAGE GALLERY --}}
    <div>
        @if($product->images->count())
        <img src="{{ asset('storage/'.$product->images->first()->path) }}"
            class="w-full h-96 object-cover rounded mb-4">

        <div class="grid grid-cols-4 gap-3">
            @foreach($product->images as $image)
            <img src="{{ asset('storage/'.$image->path) }}"
                class="h-20 object-cover rounded border">
            @endforeach
        </div>
        @else
        <div class="h-96 bg-gray-100 flex items-center justify-center text-gray-400">
            No Images Available
        </div>
        @endif
    </div>

    {{-- PRODUCT INFO --}}
    <div>
        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>

        <p class="text-xl text-green-600 mt-2">
            ₹{{ number_format($product->price, 2) }}
        </p>

        <p class="mt-4 text-gray-700">
            {{ $product->description }}
        </p>

        <p class="mt-4 text-sm text-gray-500">
            Stock: {{ $product->stock }}
        </p>

        {{-- ATTRIBUTES --}}
        @if($product->attributeValues->count())
        <div class="mt-4">
            <h3 class="font-semibold mb-2">Specifications</h3>
            <ul class="text-sm text-gray-600">
                @foreach($product->attributeValues as $value)
                <li>
                    <strong>{{ $value->attribute->name }}:</strong>
                    {{ $value->value }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- ACTIONS --}}
        <div class="mt-6">
            <button
                class="bg-black text-white px-6 py-3 rounded hover:bg-gray-800">
                Add to Cart
            </button>
        </div>
    </div>

</div>

@endsection