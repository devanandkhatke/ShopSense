@extends('layouts.admin')

@section('title', 'Seller KYC Verification')

@section('content')

<h1 class="text-2xl font-bold mb-6">Seller KYC Verification</h1>

@if($kycs->isEmpty())
<div class="bg-white p-6 rounded shadow text-gray-500">
    No KYC submissions pending verification.
</div>
@else
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-100 text-sm">
            <tr>
                <th class="p-3 text-left">Store</th>
                <th class="p-3 text-left">Seller Email</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Submitted</th>
                <th class="p-3 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kycs as $kyc)
            <tr class="border-t">
                <td class="p-3 font-medium">
                    {{ $kyc->sellerProfile->store_name }}
                </td>

                <td class="p-3 text-sm text-gray-600">
                    {{ $kyc->sellerProfile->user->email }}
                </td>

                <td class="p-3">
                    <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">
                        {{ ucfirst($kyc->status) }}
                    </span>
                </td>

                <td class="p-3 text-sm">
                    {{ $kyc->created_at->format('d M Y') }}
                </td>

                <td class="p-3">
                    <a href="{{ route('admin.kyc.show', $kyc) }}"
                        class="text-blue-600 hover:underline">
                        Review
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection