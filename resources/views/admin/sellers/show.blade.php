@extends('layouts.admin')

@section('title', 'Seller Details')

@section('content')

<h1 class="text-2xl font-bold mb-6">Seller Details</h1>

{{-- Status --}}
<div class="mb-6">
    <span class="px-3 py-1 rounded text-sm font-semibold
        @if($seller->status === 'approved') bg-green-100 text-green-800
        @elseif($seller->status === 'pending') bg-yellow-100 text-yellow-800
        @else bg-red-100 text-red-800
        @endif">
        {{ ucfirst($seller->status) }}
    </span>
</div>

{{-- Seller Info --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- User Details --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-semibold text-lg mb-4">User Information</h2>

        <p><strong>Name:</strong> {{ $seller->user->name }}</p>
        <p><strong>Email:</strong> {{ $seller->user->email }}</p>
        <p><strong>User ID:</strong> {{ $seller->user->id }}</p>
        <p><strong>Joined:</strong> {{ $seller->user->created_at->format('d M Y') }}</p>
    </div>

    {{-- Store Details --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-semibold text-lg mb-4">Store Information</h2>

        <p><strong>Store Name:</strong> {{ $seller->store_name }}</p>
        <p><strong>Slug:</strong> {{ $seller->store_slug }}</p>
        <p><strong>Description:</strong></p>
        <p class="text-sm text-gray-600 mt-1">
            {{ $seller->store_description ?? '—' }}
        </p>
    </div>

</div>

{{-- Address & KYC --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

    {{-- Address --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-semibold text-lg mb-4">Address</h2>

        <p>{{ $seller->address }}</p>
        <p>{{ $seller->city }}, {{ $seller->state }}</p>
        <p>Pincode: {{ $seller->pincode }}</p>
    </div>

    {{-- KYC --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-semibold text-lg mb-4">KYC Details</h2>

        <p><strong>GST:</strong> {{ $seller->gst_number ?? 'N/A' }}</p>
        <p><strong>PAN:</strong> {{ $seller->pan_number ?? 'N/A' }}</p>
    </div>

</div>

{{-- ACTIONS --}}
<div class="bg-white p-6 rounded shadow mt-8">
    <h2 class="font-semibold text-lg mb-4">Actions</h2>

    <div class="flex gap-4">

        @if($seller->status === 'pending')
        {{-- Approve --}}
        <form method="POST"
            action="{{ route('admin.sellers.approve', $seller) }}">
            @csrf
            <button
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Approve Seller
            </button>
        </form>

        {{-- Reject --}}
        <form method="POST"
            action="{{ route('admin.sellers.reject', $seller) }}">
            @csrf
            <button
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Reject Seller
            </button>
        </form>
        @endif

        {{-- Back --}}
        <a href="{{ route('admin.sellers.index') }}"
            class="px-4 py-2 border rounded hover:bg-gray-100">
            Back to List
        </a>

    </div>
</div>

@endsection