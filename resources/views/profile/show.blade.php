@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Profile</h2>
        <div class="mb-2">
            <span class="font-semibold">Name:</span> {{ $user->name }}
        </div>
        <div class="mb-2">
            <span class="font-semibold">Email:</span> {{ $user->email }}
        </div>
        <div class="mb-2">
            <span class="font-semibold">Joined:</span> {{ $user->created_at->format('F j, Y') }}
        </div>
        <a href="{{ route('profile.edit') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit Profile</a>
    </div>
</div>
@endsection
