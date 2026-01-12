@extends('layouts.seller')

@section('title', 'Store Profile')

@section('content')

<h1 class="text-2xl font-bold mb-6">Store Profile</h1>

@if(session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<form method="POST"
    action="{{ route('seller.store.update') }}"
    enctype="multipart/form-data"
    class="bg-white p-6 rounded shadow max-w-xl">

    @csrf

    {{-- Store Logo --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">Store Logo</label>
        <input type="file" name="store_logo">
        @if($store->store_logo)
        <img src="{{ asset('storage/'.$store->store_logo) }}"
            class="h-16 mt-2 rounded">
        @endif
    </div>

    {{-- Website --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">Website</label>
        <input type="url"
            name="website"
            value="{{ old('website', $store->website) }}"
            class="w-full border rounded px-3 py-2">
    </div>

    {{-- WhatsApp --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">WhatsApp Number *</label>
        <input type="text"
            name="whatsapp_number"
            value="{{ old('whatsapp_number', $store->whatsapp_number) }}"
            required
            class="w-full border rounded px-3 py-2">
    </div>

    {{-- Shipping Method --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">Shipping Method *</label>
        <select name="shipping_method"
            class="w-full border rounded px-3 py-2">
            <option value="self_ship" @selected($store->shipping_method === 'self_ship')>
                Self Shipping
            </option>
            <option value="platform_ship" @selected($store->shipping_method === 'platform_ship')>
                Platform Shipping
            </option>
        </select>
    </div>

    {{-- Tax --}}
    <div class="mb-6">
        <label class="block font-medium mb-1">Default Tax Rate (%) *</label>
        <input type="number"
            step="0.01"
            name="default_tax_rate"
            value="{{ old('default_tax_rate', $store->default_tax_rate) }}"
            required
            class="w-full border rounded px-3 py-2">
    </div>

    <button class="bg-black text-white px-6 py-2 rounded">
        Save Store Profile
    </button>

</form>

@endsection