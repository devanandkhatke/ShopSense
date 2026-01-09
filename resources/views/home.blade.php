@extends('layouts.app')

@section('title', 'Welcome to ShopSense')

@section('content')

{{-- HERO SECTION --}}
<div class="relative overflow-hidden bg-indigo-600 rounded-3xl shadow-xl mb-16 text-white">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-indigo-500 opacity-50 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-violet-500 opacity-50 blur-3xl"></div>

    <div class="relative z-10 p-10 md:p-16 text-center md:text-left flex flex-col md:flex-row items-center justify-between">
        <div class="max-w-xl">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-tight mb-6">
                Discover Unique Products from <span class="text-indigo-200">Trusted Sellers</span>
            </h1>
            <p class="text-lg text-indigo-100 mb-8 leading-relaxed">
                ShopSense brings you a curated marketplace of quality items. Compare prices, explore new categories, and buy with confidence.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                <a href="{{ route('shop.index') }}"
                    class="inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-indigo-600 bg-white rounded-xl hover:bg-indigo-50 transition-all shadow-lg shadow-indigo-900/20">
                    Start Shopping
                </a>
                <a href="#featured"
                    class="inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-white border-2 border-indigo-400 rounded-xl hover:bg-indigo-700/50 transition-all">
                    Explore Collections
                </a>
            </div>
        </div>

        {{-- Hero Illustration/Icon Placeholder --}}
        <div class="hidden md:block">
            <svg class="w-64 h-64 text-indigo-300 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
        </div>
    </div>
</div>

{{-- FEATURED PRODUCTS --}}
<section id="featured" class="mb-20">
    <div class="flex items-end justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">Featured Products</h2>
            <p class="text-slate-500 mt-2">Handpicked selections just for you</p>
        </div>
        <a href="{{ route('shop.index') }}" class="hidden md:flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-700">
            View all products <span aria-hidden="true" class="ml-1">&rarr;</span>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse($featuredProducts as $product)
        <a href="{{ route('shop.show', $product->slug) }}" class="group block bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">

            {{-- Product Image --}}
            <div class="relative h-64 w-full bg-slate-100 overflow-hidden">
                @if($product->primaryImage)
                <img src="{{ asset('storage/'.$product->primaryImage->path) }}"
                    alt="{{ $product->name }}"
                    class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="h-full w-full flex items-center justify-center text-slate-300">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif

                {{-- Quick Action Overlay --}}
                <div class="absolute inset-x-0 bottom-0 p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex justify-center">
                    <span class="bg-white/90 backdrop-blur text-slate-900 text-xs font-bold px-4 py-2 rounded-full shadow-lg">
                        View Details
                    </span>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="p-5">
                <h3 class="text-lg font-bold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                    {{ $product->name }}
                </h3>
                <div class="mt-2 flex items-center justify-between">
                    <p class="text-slate-500 text-sm truncate w-2/3">
                        {{ $product->category->name ?? 'General' }}
                    </p>
                    <p class="text-lg font-bold text-slate-900">
                        ₹{{ number_format($product->price, 2) }}
                    </p>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full py-12 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-300">
            <p class="text-slate-500">No featured products available at the moment.</p>
        </div>
        @endforelse
    </div>

    {{-- Mobile View All Button --}}
    <div class="mt-8 md:hidden text-center">
        <a href="{{ route('shop.index') }}" class="inline-block text-sm font-semibold text-indigo-600">
            Browse all products &rarr;
        </a>
    </div>
</section>

{{-- CATEGORY SECTIONS --}}
@foreach($categories as $category)
@if($category->products->count())
<section class="mb-20">
    <div class="flex items-center justify-between mb-6 px-1">
        <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
            {{ $category->name }}
        </h2>
        <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
            class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
            See collection
        </a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
        @foreach($category->products as $product)
        <a href="{{ route('shop.show', $product->slug) }}"
            class="group bg-white rounded-xl border border-slate-100 shadow-sm hover:shadow-lg hover:border-indigo-100 transition-all duration-300">

            <div class="aspect-square w-full overflow-hidden rounded-t-xl bg-slate-50 relative">
                @if($product->primaryImage)
                <img src="{{ asset('storage/'.$product->primaryImage->path) }}"
                    class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                @endif
            </div>

            <div class="p-4">
                <p class="text-sm font-semibold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                    {{ $product->name }}
                </p>
                <p class="text-xs text-slate-500 mt-1 font-medium">
                    ₹{{ number_format($product->price, 2) }}
                </p>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif
@endforeach

{{-- SELLER CTA --}}
<section class="relative overflow-hidden bg-slate-900 rounded-3xl p-10 md:p-16 text-center shadow-2xl">
    {{-- Decorative Background --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-4xl opacity-20 pointer-events-none">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 blur-3xl rounded-full transform scale-75"></div>
    </div>

    <div class="relative z-10 max-w-2xl mx-auto">
        <h2 class="text-3xl font-bold text-white mb-4">Start Selling on ShopSense</h2>
        <p class="text-slate-300 text-lg mb-8">
            Join thousands of successful sellers. Reach more customers, manage your inventory easily, and grow your business today.
        </p>

        @auth
        @if(auth()->user()->hasRole('customer'))
        <a href="{{ route('seller.apply') }}"
            class="inline-flex items-center px-8 py-3 rounded-full bg-indigo-600 text-white font-semibold hover:bg-indigo-500 transition-colors shadow-lg shadow-indigo-900/50">
            Apply as a Seller
        </a>
        @else
        <a href="{{ route('shop.index') }}" class="inline-flex items-center px-8 py-3 rounded-full bg-slate-800 text-slate-200 font-semibold border border-slate-700 hover:bg-slate-700 transition-colors">
            Continue Shopping
        </a>
        @endif
        @else
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 rounded-full bg-indigo-600 text-white font-semibold hover:bg-indigo-500 transition-colors shadow-lg">
                Get Started
            </a>
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 rounded-full bg-transparent border border-slate-600 text-white font-semibold hover:bg-slate-800 transition-colors">
                Login
            </a>
        </div>
        @endauth
    </div>
</section>

@endsection