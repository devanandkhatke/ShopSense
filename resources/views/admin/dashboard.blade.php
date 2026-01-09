@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')

{{-- Page Header --}}
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Dashboard Overview</h1>
        <p class="text-slate-500 text-sm mt-1">Welcome back, here's what's happening in your store today.</p>
    </div>

    <div class="mt-4 md:mt-0 flex gap-3">
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

    {{-- Total Users --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start justify-between transition-transform hover:-translate-y-1 duration-300">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Users</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['total_users'] }}</h3>
            <p class="text-xs text-emerald-600 font-medium mt-1 flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                Active Base
            </p>
        </div>
        <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
    </div>

    {{-- Total Sellers --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start justify-between transition-transform hover:-translate-y-1 duration-300">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Sellers</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['total_sellers'] }}</h3>
            <p class="text-xs text-slate-400 font-medium mt-1">Registered Partners</p>
        </div>
        <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
    </div>

    {{-- Total Products --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start justify-between transition-transform hover:-translate-y-1 duration-300">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Products</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['total_products'] }}</h3>
            <p class="text-xs text-slate-400 font-medium mt-1">Across all categories</p>
        </div>
        <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
    </div>

</div>

{{-- ATTENTION REQUIRED & QUICK ACTIONS --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    {{-- Left Column: Pending Actions --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Pending Sellers Alert --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-16 h-16 bg-amber-50 rounded-bl-full -mr-2 -mt-2 z-0"></div>

            <div class="relative z-10 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-amber-100 text-amber-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Pending Seller Applications</h3>
                        <p class="text-slate-500 text-sm">New partners waiting for verification.</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-amber-600">{{ $stats['pending_sellers'] }}</p>
                </div>
            </div>

            @if($stats['pending_sellers'] > 0)
            <div class="mt-6 border-t border-slate-100 pt-4">
                <a href="{{ route('admin.sellers.index') }}" class="inline-flex items-center text-sm font-medium text-amber-600 hover:text-amber-700">
                    Review Applications
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            @endif
        </div>

        {{-- Pending Products Alert --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-16 h-16 bg-red-50 rounded-bl-full -mr-2 -mt-2 z-0"></div>

            <div class="relative z-10 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-red-100 text-red-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Pending Products</h3>
                        <p class="text-slate-500 text-sm">Items requiring admin approval before publishing.</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-red-600">{{ $stats['pending_products'] }}</p>
                </div>
            </div>

            @if($stats['pending_products'] > 0)
            <div class="mt-6 border-t border-slate-100 pt-4">
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-700">
                    Review Products
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            @endif
        </div>

    </div>

    {{-- Right Column: Quick Actions & Chart Placeholder --}}
    <div class="space-y-6">

        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-slate-800 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('admin.sellers.index') }}" class="flex flex-col items-center justify-center p-4 bg-slate-50 rounded-lg hover:bg-slate-100 hover:shadow-md transition-all text-center">
                    <span class="text-xl mb-1">🧑‍💼</span>
                    <span class="text-xs font-medium text-slate-600">Approve Sellers</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex flex-col items-center justify-center p-4 bg-slate-50 rounded-lg hover:bg-slate-100 hover:shadow-md transition-all text-center">
                    <span class="text-xl mb-1">📦</span>
                    <span class="text-xs font-medium text-slate-600">Approve Products</span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center p-4 bg-slate-50 rounded-lg hover:bg-slate-100 hover:shadow-md transition-all text-center">
                    <span class="text-xl mb-1">🏷️</span>
                    <span class="text-xs font-medium text-slate-600">Attributes</span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center p-4 bg-slate-50 rounded-lg hover:bg-slate-100 hover:shadow-md transition-all text-center">
                    <span class="text-xl mb-1">📂</span>
                    <span class="text-xs font-medium text-slate-600">Categories</span>
                </a>
            </div>
        </div>

        {{-- Mini Chart Placeholder --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-slate-800">Approved Products</h3>
                <span class="text-sm font-bold text-emerald-600">{{ $stats['approved_products'] }}</span>
            </div>
            {{-- Visual Representation of "Good" vs "Pending" --}}
            <div class="w-full bg-slate-100 rounded-full h-2.5 mb-2">
                @php
                $total_prods = $stats['total_products'] > 0 ? $stats['total_products'] : 1;
                $percent = ($stats['approved_products'] / $total_prods) * 100;
                @endphp
                <div class="bg-emerald-500 h-2.5 rounded-full" style="width: {{ $percent }}%"></div>
            </div>
            <p class="text-xs text-slate-500">{{ round($percent) }}% of catalog is live</p>
        </div>

    </div>

</div>

{{-- Chart / Visual Placeholder --}}
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <h3 class="font-bold text-slate-800 mb-6">Platform Activity</h3>
    {{-- CSS Chart Placeholder --}}
    <div class="flex items-end justify-between h-48 gap-2">
        @foreach(range(1, 12) as $i)
        <div class="w-full bg-indigo-50 rounded-t-md relative group">
            @php $h = rand(30, 90); @endphp
            <div style="height: {{ $h }}%;" class="absolute bottom-0 w-full bg-indigo-500 rounded-t-md transition-all group-hover:bg-indigo-600"></div>
        </div>
        @endforeach
    </div>
    <div class="flex justify-between mt-2 text-xs text-slate-400 px-2">
        <span>Jan</span><span>Dec</span>
    </div>
</div>

@endsection