@extends('layouts.seller')

@section('title', 'Seller Dashboard')

@section('content')

{{-- Page Header --}}
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Store Overview</h1>
        <p class="text-slate-500 text-sm mt-1">Welcome back! Manage your inventory and product listings.</p>
    </div>

    <div class="mt-4 md:mt-0">
        <span class="inline-flex items-center px-3 py-1 rounded-md bg-white border border-slate-200 text-sm text-slate-600 shadow-sm">
            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{ date('M d, Y') }}
        </span>
    </div>
</div>

{{-- PRIMARY STATS GRID --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Total Products --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start justify-between transition-transform hover:-translate-y-1 duration-300">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Products</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['total_products'] }}</h3>
            <p class="text-xs text-slate-400 font-medium mt-1">Listed Items</p>
        </div>
        <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
    </div>

    {{-- Approved Products --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start justify-between transition-transform hover:-translate-y-1 duration-300">
        <div>
            <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Live & Active</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['approved_products'] }}</h3>
            <p class="text-xs text-slate-400 font-medium mt-1">Approved for sale</p>
        </div>
        <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    {{-- Pending Products --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start justify-between transition-transform hover:-translate-y-1 duration-300">
        <div>
            <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Pending Review</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['pending_products'] }}</h3>
            <p class="text-xs text-slate-400 font-medium mt-1">Awaiting admin approval</p>
        </div>
        <div class="p-3 bg-amber-50 rounded-lg text-amber-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

</div>

{{-- INVENTORY & ACTIONS GRID --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Inventory Health --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Inventory Summary Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-slate-800 mb-4">Inventory Health</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Total Inventory --}}
                <div class="p-4 border border-slate-100 rounded-lg bg-slate-50 flex items-center gap-4">
                    <div class="p-2 bg-blue-100 text-blue-600 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold text-slate-800">{{ $stats['total_stock'] }}</span>
                        <span class="text-xs text-slate-500 font-medium">Total Units in Stock</span>
                    </div>
                </div>

                {{-- Low Stock Alert --}}
                <div class="p-4 border border-red-100 rounded-lg bg-red-50 flex items-center gap-4">
                    <div class="p-2 bg-red-100 text-red-600 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold text-red-700">{{ $stats['low_stock_products'] }}</span>
                        <span class="text-xs text-red-600 font-medium">Low Stock Alerts (≤ 5)</span>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Quick Navigation</h4>
                <div class="flex gap-3">
                    <a href="{{ route('seller.products.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                        View All Inventory
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- Quick Actions Panel --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 h-fit">
        <h3 class="font-bold text-slate-800 mb-4">Quick Actions</h3>

        <div class="space-y-3">
            <a href="{{ route('seller.products.create') }}" class="group w-full flex items-center justify-between p-4 bg-indigo-600 text-white rounded-lg shadow-sm hover:bg-indigo-700 transition-all">
                <span class="flex items-center gap-3 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Product
                </span>
                <span class="bg-indigo-500 p-1 rounded group-hover:bg-indigo-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </a>

            <a href="{{ route('seller.products.index') }}" class="group w-full flex items-center justify-between p-4 bg-slate-50 text-slate-700 rounded-lg border border-slate-200 hover:bg-slate-100 transition-all">
                <span class="flex items-center gap-3 font-medium">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    Manage Products
                </span>
            </a>
        </div>

        <div class="mt-6 pt-6 border-t border-slate-100">
            <p class="text-xs text-slate-400 mb-2">Need help?</p>
            <a href="#" class="text-sm text-slate-600 hover:text-indigo-600 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Seller Support Center
            </a>
        </div>
    </div>

</div>

@endsection