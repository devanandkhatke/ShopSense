@extends('layouts.admin')

@section('title', 'Edit Attribute')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Edit Attribute: {{ $attribute->name }}
</h1>

{{-- Update Attribute --}}
<form method="POST"
    action="{{ route('admin.attributes.update', $attribute) }}"
    class="bg-white p-6 rounded shadow max-w-xl mb-8">
    @csrf
    @method('PUT')

    <label class="block mb-2 font-semibold">Attribute Name</label>
    <input name="name"
        value="{{ $attribute->name }}"
        class="w-full border rounded p-2 mb-4"
        required>

    <label class="block mb-2 font-semibold">Assign to Categories</label>
    <div class="grid grid-cols-2 gap-2 mb-4">
        @foreach($categories as $category)
        <label class="flex items-center gap-2">
            <input type="checkbox"
                name="categories[]"
                value="{{ $category->id }}"
                {{ $attribute->categories->contains($category) ? 'checked' : '' }}>
            {{ $category->name }}
        </label>
        @endforeach
    </div>

    <button class="bg-black text-white px-4 py-2 rounded">
        Save Changes
    </button>
</form>

{{-- Attribute Values --}}
<div class="bg-white p-6 rounded shadow max-w-xl">
    <h2 class="font-semibold mb-4">Attribute Values</h2>

    <form method="POST"
        action="{{ route('admin.attributes.values.store', $attribute) }}"
        class="flex gap-2 mb-4">
        @csrf
        <input name="value"
            placeholder="New value"
            class="flex-1 border rounded p-2"
            required>
        <button class="bg-gray-800 text-white px-3 rounded">Add</button>
    </form>

    <ul>
        @foreach($attribute->values as $value)
        <li class="flex justify-between border-b py-2">
            {{ $value->value }}

            <form method="POST"
                action="{{ route('admin.attributes.values.destroy', $value) }}">
                @csrf
                @method('DELETE')
                <button class="text-red-600 text-sm">Delete</button>
            </form>
        </li>
        @endforeach
    </ul>
</div>

@endsection