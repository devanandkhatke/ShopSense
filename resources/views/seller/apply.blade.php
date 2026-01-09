@extends('layouts.app')

@section('title', 'Apply as Seller')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">

    <h2 class="text-2xl font-bold mb-2">Apply as a Seller</h2>
    <p class="text-gray-600 mb-6">
        Submit your business details for review. Approval usually takes 24–48 hours.
    </p>

    <form method="POST" action="{{ route('seller.apply.store') }}">
        @csrf

        {{-- Business Identity --}}
        <h3 class="font-semibold mb-3">Business Information</h3>

        <input name="business_name" class="input" placeholder="Legal Business Name" required>

        <input name="store_display_name" class="input mt-3"
            placeholder="Store Display Name" required>

        <div class="grid grid-cols-2 gap-4 mt-3">
            <select name="business_type" class="input" required>
                <option value="">Business Type</option>
                <option>Individual</option>
                <option>Partnership</option>
                <option>LLP</option>
                <option>Private Limited</option>
            </select>

            <input name="industry" class="input" placeholder="Industry / Category" required>
        </div>

        <textarea name="store_description" class="input mt-3"
            placeholder="Business Description"></textarea>

        <div class="grid grid-cols-2 gap-4 mt-3">
            <input name="gst_number" class="input"
                placeholder="GSTIN (15 characters)" required>

            <input name="pan_number" class="input"
                placeholder="PAN (Optional)">
        </div>

        {{-- Contact --}}
        <h3 class="font-semibold mt-6 mb-3">Primary Contact</h3>

        <input name="contact_name" class="input"
            placeholder="Contact Person Name" required>

        <input name="contact_phone" class="input mt-3"
            placeholder="Mobile Number" required>

        <input value="{{ auth()->check() ? auth()->user()->email : '' }}" disabled
            class="input mt-3 bg-gray-100">

        {{-- Address --}}
        <h3 class="font-semibold mt-6 mb-3">Registered Address</h3>

        <textarea name="address" class="input" placeholder="Address" required></textarea>

        <div class="grid grid-cols-3 gap-4 mt-3">
            <input name="city" class="input" placeholder="City" required>
            <input name="state" class="input" placeholder="State" required>
            <input name="pincode" class="input" placeholder="Pincode" required>
        </div>

        {{-- Account Setup --}}
        <h3 class="font-semibold mt-6 mb-3">Account Setup</h3>

        <input name="email" class="input"
            placeholder="Email Address" required>

        <input name="password" type="password" class="input mt-3"
            placeholder="Password" required>

        <input name="password_confirmation" type="password"
            class="input mt-3"
            placeholder="Confirm Password" required>


        <button
            class="mt-6 w-full bg-black text-white py-3 rounded hover:bg-gray-800">
            Submit Application
        </button>
    </form>

</div>

@endsection