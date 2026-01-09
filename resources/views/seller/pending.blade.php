@extends('layouts.seller')

@section('title', 'Seller Application Status')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl">
    <h2 class="text-xl font-semibold mb-2">Seller Application Status</h2>

    <p class="text-yellow-600 font-medium mb-2">
        Your application is currently:
    </p>

    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded">
        Pending Review
    </span>

    <p class="text-sm text-gray-600 mt-4">
        Our team will review your details within 24–48 hours.
    </p>
</div>
@endsection