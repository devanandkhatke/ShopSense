@extends('layouts.admin')

@section('title', 'Attributes')

@section('content')

<h1 class="text-2xl font-bold mb-6">Attributes</h1>

{{-- Create Attribute --}}
<form method="POST" action="{{ route('attributes.store') }}"
    class="bg-white p-4 rounded shadow mb-6 max-w-md">
    @csrf
    <label class="block mb-2 font-semibold">New Attribute</label>
    <input name="name" class="w-full border rounded p-2 mb-3" required>

    <button class="bg-black text-white px-4 py-2 rounded">
        Add Attribute
    </button>
</form>

{{-- Attribute Table --}}
<div class="bg-white rounded shadow">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Attribute</th>
                <th class="p-3">Values</th>
                <th class="p-3">Categories</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attributes as $attribute)
            <tr class="border-t">
                <td class="p-3 font-semibold">
                    {{ $attribute->name }}
                </td>

                <td class="p-3">
                    {{ $attribute->values->pluck('value')->join(', ') }}
                </td>

                <td class="p-3">
                    {{ $attribute->categories->pluck('name')->join(', ') }}
                </td>

                <td class="p-3">
                    <a href="{{ route('admin.attributes.edit', $attribute) }}"
                        class="text-blue-600">
                        Manage
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection