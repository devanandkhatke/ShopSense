@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="max-w-lg mx-auto text-center py-16">
    <h1 class="text-4xl font-bold mb-4 text-red-600">404</h1>
    <p class="text-lg mb-6">Sorry, the page you are looking for could not be found.</p>
    <a href="{{ url('/') }}" class="text-indigo-600 hover:underline">Go to Homepage</a>
</div>
@endsection
