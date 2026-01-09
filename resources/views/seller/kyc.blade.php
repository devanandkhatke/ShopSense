@extends('layouts.seller')

@section('title', 'KYC Verification')

@section('content')

@php
$sellerProfile = auth()->user()->sellerProfile;
$kycVerified = $sellerProfile->status === 'active';

@endphp

<h1 class="text-2xl font-bold mb-6">KYC Verification</h1>

{{-- Success flash --}}
@if(session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

{{-- KYC VERIFIED --}}
@if($kycVerified)
<div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
    <p class="font-semibold text-green-800">
        ✅ Your KYC is verified
    </p>
    <p class="text-sm text-green-700">
        You now have full seller access.
    </p>
</div>

{{-- KYC NOT VERIFIED --}}
@else
<div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
    <p class="font-semibold text-yellow-800">
        Attention Needed
    </p>
    <p class="text-sm text-yellow-700">
        Complete KYC to unlock seller features.
    </p>
</div>

<form method="POST"
    action="{{ route('seller.kyc.update') }}"
    enctype="multipart/form-data"
    class="bg-white p-6 rounded shadow max-w-xl">
    @csrf

    <label class="block mb-3">
        GST Certificate
        <input type="file" name="gst_certificate" required>
    </label>

    <label class="block mb-3">
        Business Registration Document
        <input type="file" name="business_registration_doc" required>
    </label>

    <label class="block mb-3">
        Owner ID Proof
        <input type="file" name="id_proof" required>
    </label>

    <label class="block mb-4">
        Cancelled Cheque
        <input type="file" name="cancelled_cheque" required>
    </label>

    <button class="bg-black text-white px-6 py-2 rounded">
        Submit KYC
    </button>
</form>
@endif

@endsection