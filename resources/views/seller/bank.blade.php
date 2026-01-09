@extends('layouts.seller')

@section('title', 'Bank Details')

@section('content')

<h2 class="text-xl font-bold mb-4">Bank Account</h2>

<form method="POST" action="{{ route('seller.bank.update') }}"
    class="bg-white p-6 rounded shadow max-w-lg">
    @csrf

    <input name="account_holder_name" class="input" placeholder="Account Holder Name" required>
    <input name="bank_name" class="input mt-3" placeholder="Bank Name" required>
    <input name="account_number" class="input mt-3" placeholder="Account Number" required>
    <input name="ifsc_code" class="input mt-3" placeholder="IFSC Code" required>

    <button class="mt-4 bg-black text-white px-4 py-2 rounded">
        Save Bank Details
    </button>
</form>

@endsection