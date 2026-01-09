@extends('layouts.admin')

@section('title', 'Seller Applications')

@section('content')

<h1 class="text-2xl font-bold mb-6">Seller Applications</h1>

@if(session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">User</th>
                <th class="p-3 text-left">Store</th>
                <th class="p-3 text-left">Location</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($sellers as $seller)
            <tr class="border-t">
                {{-- User --}}
                <td class="p-3">
                    <div class="font-semibold">{{ $seller->user->name }}</div>
                    <div class="text-sm text-gray-500">{{ $seller->user->email }}</div>
                </td>

                {{-- Store --}}
                <td class="p-3">
                    {{ $seller->store_name }}
                </td>

                {{-- Location --}}
                <td class="p-3 text-sm">
                    {{ $seller->city }}, {{ $seller->state }} - {{ $seller->pincode }}
                </td>

                {{-- Status --}}
                <td class="p-3">
                    @switch($seller->status)
                    @case('pending')
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-sm">
                        Application Pending
                    </span>
                    @break

                    @case('approved')
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm">
                        Approved – Awaiting KYC
                    </span>
                    @break

                    @case('kyc_pending')
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded text-sm">
                        KYC Submitted
                    </span>
                    @break

                    @case('active')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-sm">
                        Active Seller
                    </span>
                    @break

                    @case('rejected')
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm">
                        Rejected
                    </span>
                    @break
                    @endswitch
                </td>

                {{-- Actions --}}
                <td class="p-3">
                    <div class="flex gap-2">

                        {{-- Approve Application --}}
                        @if($seller->status === 'pending')
                        <form method="POST" action="{{ route('admin.sellers.approve', $seller) }}">
                            @csrf
                            <button class="bg-green-600 text-white px-3 py-1 rounded">
                                Approve
                            </button>
                        </form>
                        @endif

                        {{-- Review KYC --}}
                        @if($seller->status === 'kyc_pending')
                        <a href="{{ route('admin.kyc.show', $seller->id) }}"
                            class="bg-indigo-600 text-white px-3 py-1 rounded">
                            Review KYC
                        </a>
                        @endif

                        {{-- Reject --}}
                        @if(in_array($seller->status, ['pending','approved']))
                        <form method="POST" action="{{ route('admin.sellers.reject', $seller) }}">
                            @csrf
                            <button class="bg-red-600 text-white px-3 py-1 rounded">
                                Reject
                            </button>
                        </form>
                        @endif

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-6 text-center text-gray-500">
                    No seller applications found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection