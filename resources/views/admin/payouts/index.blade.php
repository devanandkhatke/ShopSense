@extends('layouts.admin')

@section('title', 'Seller Payouts')

@section('content')

<h1 class="text-xl font-bold mb-4">Payout Requests</h1>

@foreach($payouts as $payout)
<div class="bg-white p-4 rounded shadow mb-3">
    <p>Seller: {{ $payout->sellerProfile->store_display_name }}</p>
    <p>Amount: ₹{{ $payout->amount }}</p>

    <form method="POST" action="{{ route('admin.payout.paid', $payout) }}">
        @csrf
        <button class="bg-green-600 text-white px-4 py-1 rounded mt-2">
            Mark as Paid
        </button>
    </form>
</div>
@endforeach

@endsection