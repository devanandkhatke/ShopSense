@extends('layouts.admin')

@section('title', 'Active Sellers')

@section('content')

<h1 class="text-2xl font-bold mb-6">Active Sellers</h1>

@if($sellers->isEmpty())
<div class="bg-white p-6 rounded shadow">
    <p class="text-gray-500">No active sellers found.</p>
</div>
@else
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Seller</th>
                <th class="p-3 text-left">Store</th>
                <th class="p-3 text-left">Location</th>
                <th class="p-3 text-left">KYC</th>
                <th class="p-3 text-left">Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($sellers as $seller)
            <tr class="border-t">
                <td class="p-3">
                    <div class="font-semibold">
                        {{ $seller->user->name }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $seller->user->email }}
                    </div>
                </td>

                <td class="p-3">
                    <div class="font-semibold">
                        {{ $seller->store_name }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $seller->store_slug }}
                    </div>
                </td>

                <td class="p-3 text-sm">
                    {{ $seller->city }}, {{ $seller->state }} <br>
                    {{ $seller->pincode }}
                </td>

                <td class="p-3 text-sm">
                    <div>GST: {{ $seller->gst_number ?? 'N/A' }}</div>
                    <div>PAN: {{ $seller->pan_number ?? 'N/A' }}</div>
                </td>

                <td class="p-3">
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                        Approved
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection