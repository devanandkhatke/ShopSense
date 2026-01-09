@extends('layouts.seller')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Seller Profile</h2>
    @include('profile.partials.update-profile-information-form')
    <hr class="my-6">
    @include('profile.partials.update-password-form')
    <hr class="my-6">
    @include('profile.partials.delete-user-form')
</div>
@endsection
