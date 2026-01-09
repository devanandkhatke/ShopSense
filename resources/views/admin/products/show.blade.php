@extends('layouts.admin')

@section('title', $product->name)

@section('content')

<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold">{{ $product->name }}</h1>

    <div class="space-x-2">
        @if($product->status !== 'approved')
        <form method="POST" action="{{ route('admin.products.approve', $product) }}" class="inline">
            @csrf
            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Approve
            </button>
        </form>
        @endif

        @if($product->status !== 'rejected')
        <form method="POST" action="{{ route('admin.products.reject', $product) }}" class="inline">
            @csrf
            <button class="bg-red-600 text-white px-4 py-2 rounded">
                Reject
            </button>
        </form>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- Product Info --}}
    <div class="bg-white p-6 rounded shadow md:col-span-2">
        <h2 class="font-semibold mb-3">Product Details</h2>

        <p><strong>Category:</strong> {{ $product->category->name ?? '-' }}</p>
        <p><strong>Seller:</strong> {{ $product->seller->name ?? '-' }}</p>
        <p><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
        <p><strong>Status:</strong>
            <span class="capitalize px-2 py-1 rounded
                @if($product->status === 'approved') bg-green-100 text-green-800
                @elseif($product->status === 'rejected') bg-red-100 text-red-800
                @else bg-yellow-100 text-yellow-800
                @endif">
                {{ $product->status }}
            </span>
        </p>

        <p class="mt-4 text-gray-700">
            {{ $product->description }}
        </p>
    </div>

    {{-- Images --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-semibold mb-3">Images</h2>

        <div class="grid grid-cols-2 gap-2">
            @forelse($product->images as $image)
            <img src="{{ asset('storage/'.$image->path) }}"
                class="rounded border">
            @empty
            <p class="text-gray-500 text-sm">No images uploaded</p>
            @endforelse
        </div>
    </div>

</div>

{{-- Variants --}}
@if($product->variants->count())
<div class="mt-6 bg-white p-6 rounded shadow">
    <h2 class="font-semibold mb-3">Variants</h2>

    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Variant</th>
                <th class="p-2">Price</th>
                <th class="p-2">Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product->variants as $variant)
            <tr class="border-t">
                <td class="p-2">
                    @foreach($variant->attributeValues as $value)
                    <span class="text-sm bg-gray-200 px-2 py-1 rounded">
                        {{ $value->attribute->name }}: {{ $value->value }}
                    </span>
                    @endforeach
                </td>
                <td class="p-2">₹{{ number_format($variant->price, 2) }}</td>
                <td class="p-2">{{ $variant->stock }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection