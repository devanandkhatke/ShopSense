@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')

<h1 class="text-2xl font-bold mb-6">My Wishlist</h1>

@if($items->isEmpty())
<p class="text-gray-500">Your wishlist is empty.</p>
@else
<div class="bg-white rounded shadow divide-y">
    @foreach($items as $item)
    <div class="flex justify-between p-4">
        <div>
            <h2 class="font-semibold">
                {{ $item->product->name }}
            </h2>
        </div>

        <form method="POST" action="{{ route('wishlist.destroy', $item) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-600">Remove</button>
        </form>
    </div>
    @endforeach
</div>
@endif

@endsection