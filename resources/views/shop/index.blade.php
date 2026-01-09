@extends('layouts.app')

@section('title', 'Shop')
@section('filters')
@include('partials.filters')
@endsection

@section('content')

<div class="flex flex-col lg:flex-row gap-6">


    {{-- PRODUCT GRID --}}
    <main class="flex-1">

        <h1 class="text-2xl font-bold mb-6">Shop</h1>

        @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            @foreach($products as $product)
            <a href="{{ route('shop.show', $product->slug) }}"
                class="bg-white rounded shadow hover:shadow-lg transition">

                {{-- Image --}}
                @if($product->primaryImage)
                <img src="{{ asset('storage/'.$product->primaryImage->path) }}"
                    class="h-48 w-full object-cover rounded-t">
                @else
                <div class="h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                    No Image
                </div>
                @endif

                {{-- Info --}}
                <div class="p-4">
                    <h3 class="font-semibold truncate">
                        {{ $product->name }}
                    </h3>

                    <p class="text-gray-600 text-sm mt-1">
                        ₹{{ number_format($product->price, 2) }}
                    </p>
                </div>
            </a>
            @endforeach

        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $products->links() }}
        </div>
        @else
        <p class="text-gray-500">No products found.</p>
        @endif

    </main>
</div>

@endsection