@extends('layouts.seller')

@section('title', 'Access Denied')

@section('content')
<div class="max-w-lg mx-auto text-center py-16">
    <h1 class="text-4xl font-bold mb-4 text-yellow-600">403</h1>
    <p class="text-lg mb-6">You do not have permission to access this page.</p>
    <a href="{{ url('/') }}" class="text-indigo-600 hover:underline">Go to Homepage</a>
</div>
@endsection
