@extends('layouts.admin')

@section('title', 'Review Seller KYC')

@section('content')

<h1 class="text-2xl font-bold mb-6">Review Seller KYC</h1>

@if(session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded p-6 max-w-3xl">

    <h2 class="text-lg font-semibold mb-4">
        Seller: {{ $kyc->sellerProfile->user->name }}
    </h2>

    <ul class="mb-6 text-sm space-y-2">
        <li><strong>GST:</strong> {{ $kyc->gst_number }}</li>
        <li><strong>PAN:</strong> {{ $kyc->pan_number }}</li>
    </ul>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <a href="{{ asset('storage/'.$kyc->gst_certificate) }}" target="_blank"
            class="text-blue-600 underline">GST Certificate</a>

        <a href="{{ asset('storage/'.$kyc->business_registration_doc) }}" target="_blank"
            class="text-blue-600 underline">Business Registration</a>

        <a href="{{ asset('storage/'.$kyc->id_proof) }}" target="_blank"
            class="text-blue-600 underline">Owner ID Proof</a>

        <a href="{{ asset('storage/'.$kyc->cancelled_cheque) }}" target="_blank"
            class="text-blue-600 underline">Cancelled Cheque</a>
    </div>

    {{-- APPROVE KYC --}}
    @if($kyc->status !== 'verified')
    <form method="POST"
        action="{{ route('admin.kyc.approve', $kyc) }}">
        @csrf
        <button class="bg-green-600 text-white px-6 py-2 rounded">
            Approve KYC & Activate Seller
        </button>
    </form>
    @else
    <span class="bg-green-100 text-green-700 px-4 py-2 rounded">
        KYC Verified – Seller Active
    </span>
    @endif

</div>

@endsection