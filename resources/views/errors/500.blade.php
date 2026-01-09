@extends('layouts.app')

@section('title', 'Server Error')

@section('content')
<div class="max-w-lg mx-auto text-center py-16">
    <h1 class="text-4xl font-bold mb-4 text-gray-700">500</h1>
    <p class="text-lg mb-6">Whoops! Something went wrong on our servers.</p>
    <a href="{{ url('/') }}" class="text-indigo-600 hover:underline">Go to Homepage</a>
</div>
@endsection
