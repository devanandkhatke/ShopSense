@extends('layouts.seller')

@section('title', 'Payouts')

@section('content')

<h2 class="text-xl font-bold mb-4">Payouts</h2>

<div class="bg-white p-4 rounded shadow mb-6">
    <p>Available Balance: <strong>₹{{ $wallet->available_balance }}</strong></p>
    <p>Pending Balance: ₹{{ $wallet->pending_balance }}</p>
</div>

<form method="POST" action="{{ route('seller.payout.request') }}"
    class="bg-white p-6 rounded shadow max-w-sm">
    @csrf
    <input name="amount" class="input" placeholder="Amount">
    <button class="mt-3 bg-black text-white px-4 py-2 rounded">
        Request Payout
    </button>
</form>

@endsection