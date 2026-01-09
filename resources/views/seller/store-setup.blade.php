@extends('layouts.seller')

@section('title', 'Store Setup')

@section('content')

<h1 class="text-2xl font-bold mb-6">Store Setup</h1>

<form method="POST" action="{{ route('seller.store.update') }}"
    class="bg-white p-6 rounded shadow max-w-xl">
    @csrf

    <label class="block mb-3">
        Website
        <input name="website" value="{{ $store->website }}" class="input">
    </label>

    <label class="block mb-3">
        WhatsApp Business Number
        <input name="whatsapp_number" value="{{ $store->whatsapp_number }}" class="input">
    </label>

    <label class="block mb-3">
        Shipping Method
        <select name="shipping_method" class="input">
            <option value="self_ship">Self Ship</option>
            <option value="platform_ship">Platform Logistics</option>
        </select>
    </label>

    <label class="block mb-4">
        Default Tax Rate (%)
        <input name="default_tax_rate" value="{{ $store->default_tax_rate }}" class="input">
    </label>

    <button class="bg-black text-white px-6 py-2 rounded">
        Save Store Settings
    </button>
</form>

@endsection