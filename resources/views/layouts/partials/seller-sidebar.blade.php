@php
$sellerProfile = auth()->user()->sellerProfile ?? null;
$isSellerActive = $sellerProfile && $sellerProfile->isActive();
@endphp

<div class="h-16 flex items-center px-6 bg-slate-950 border-b border-slate-800 shadow-sm">
    <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded bg-emerald-500 flex items-center justify-center text-white font-bold text-lg">
            S
        </div>
        <div>
            <h1 class="font-bold text-lg tracking-wide text-white">ShopSense</h1>
            <p class="text-xs text-slate-400 font-medium">Seller Panel</p>
        </div>
    </div>
</div>

<nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">

    {{-- Dashboard --}}
    <a href="{{ route('seller.dashboard') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
       {{ request()->routeIs('seller.dashboard')
          ? 'bg-indigo-600 text-white'
          : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        Dashboard
    </a>

    <div class="pt-5 pb-2 px-3">
        <p class="text-xs font-semibold text-slate-500 uppercase">Store Management</p>
    </div>

    {{-- Products --}}
    @if($isSellerActive)
    <a href="{{ route('seller.products.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-300 hover:bg-slate-800">
        Products
    </a>
    @else
    <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-500 cursor-not-allowed">
        Products <span class="ml-auto text-xs border rounded px-2">Locked</span>
    </div>
    @endif

    {{-- Orders --}}
    @if($isSellerActive)
    <a href="#"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-300 hover:bg-slate-800">
        Orders
    </a>
    @else
    <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-500 cursor-not-allowed">
        Orders
    </div>
    @endif

    {{-- Store Profile --}}
    @if($isSellerActive)
    <a href="#"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-300 hover:bg-slate-800">
        Store Profile
    </a>
    @else
    <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-500 cursor-not-allowed">
        Store Profile
    </div>
    @endif

    <div class="pt-5 pb-2 px-3">
        <p class="text-xs font-semibold text-slate-500 uppercase">Finance & Settings</p>
    </div>

    {{-- KYC --}}
    <a href="{{ route('seller.kyc.edit') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm
       {{ request()->routeIs('seller.kyc.*')
          ? 'bg-indigo-600 text-white'
          : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
        KYC Verification
    </a>

    {{-- Bank --}}
    <a href="{{ route('seller.bank.edit') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-300 hover:bg-slate-800">
        Bank Details
    </a>

    {{-- Payouts --}}
    <a href="{{ route('seller.payout.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-300 hover:bg-slate-800">
        Payouts
    </a>

</nav>