@extends('layouts.seller')

@section('title', 'My Profile')

@section('content')

<h1 class="text-2xl font-bold mb-6">Seller Profile</h1>

@if(session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('seller.profile.update') }}"
    class="bg-white p-6 rounded shadow max-w-lg">
    @csrf

    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Name</label>
        <input
            type="text"
            name="name"
            value="{{ auth()->user()->name }}"
            class="w-full border px-3 py-2 rounded"
            required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Email</label>
        <input
            type="email"
            name="email"
            value="{{ auth()->user()->email }}"
            class="w-full border px-3 py-2 rounded"
            required>
    </div>

    <button class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
        Update Profile
    </button>
</form>

@endsection