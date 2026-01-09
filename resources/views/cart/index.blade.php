@extends('layouts.app')

@section('title', 'My Cart')

@section('content')

<h1 class="text-2xl font-bold mb-6">My Cart</h1>

@if($items->isEmpty())
<p class="text-gray-500">Your cart is empty.</p>
@else
<div class="bg-white rounded shadow divide-y">
    @foreach($items as $item)
    <div class="flex justify-between p-4">
        <div>
            <h2 class="font-semibold">
                {{ $item->product->name }}
            </h2>
            <p class="text-sm text-gray-500">
                Quantity: {{ $item->quantity }}
            </p>
        </div>

        <form method="POST" action="{{ route('cart.destroy', $item) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-600">Remove</button>
        </form>
    </div>
    @endforeach
</div>
@endif

@endsection