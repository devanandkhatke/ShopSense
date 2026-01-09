<div class="h-16 flex items-center px-6 bg-slate-950 border-b border-slate-800 shadow-sm">
    <div class="flex items-center gap-3">
        {{-- Simple Logo Icon --}}
        <div class="w-8 h-8 rounded bg-indigo-500 flex items-center justify-center text-white font-bold text-lg">
            S
        </div>
        <div>
            <h1 class="font-bold text-lg tracking-wide text-white">ShopSense</h1>
            <p class="text-xs text-slate-400 font-medium">Admin Panel</p>
        </div>
    </div>
</div>

<nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
       {{ request()->routeIs('admin.dashboard') 
          ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' 
          : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
        </svg>
        Dashboard
    </a>

    {{-- Section Header --}}
    <div class="pt-5 pb-2 px-3">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Platform</p>
    </div>

    {{-- Sellers --}}
    <a href="{{ route('admin.sellers.active') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
       {{ request()->routeIs('admin.sellers.active') 
          ? 'bg-indigo-600 text-white' 
          : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        Active Sellers
    </a>

    <a href="{{ route('admin.sellers.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
       {{ request()->routeIs('admin.sellers.index') 
          ? 'bg-indigo-600 text-white' 
          : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Seller Applications
    </a>

    <a href="{{ route('admin.kyc.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
       {{ request()->routeIs('admin.kyc.*') 
          ? 'bg-indigo-600 text-white' 
          : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Seller KYC
    </a>

    <a href="{{ route('admin.products.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
       {{ request()->routeIs('admin.products.*') 
          ? 'bg-indigo-600 text-white' 
          : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
        Products
    </a>

    {{-- Section Header --}}
    <div class="pt-5 pb-2 px-3">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Finance</p>
    </div>

    <a href="{{ route('admin.payouts.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
       {{ request()->routeIs('admin.payouts.*') 
          ? 'bg-indigo-600 text-white' 
          : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Seller Payouts
    </a>

</nav>