@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

<h1 class="text-2xl font-bold mb-6">Categories</h1>

{{-- CREATE CATEGORY --}}
<div class="bg-white p-6 rounded shadow mb-8 max-w-md">
    <h2 class="font-semibold mb-4">Add New Category</h2>

    <form method="POST" action="{{ url('/admin/categories') }}">
        @csrf

        <label class="block mb-2 text-sm font-medium">
            Category Name
        </label>

        <input type="text"
            name="name"
            class="w-full border rounded p-2 mb-3"
            placeholder="e.g. Electronics"
            required>

        @error('name')
        <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
        @enderror

        <button class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
            Add Category
        </button>
    </form>
</div>

{{-- CATEGORY TABLE --}}
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">#</th>
                <th class="p-3 text-left">Category</th>
                <th class="p-3 text-left">Slug</th>
                <th class="p-3 text-left">Attributes</th>
                <th class="p-3 text-left">Created</th>
            </tr>
        </thead>

        <tbody>
            @forelse($categories as $category)
            <tr class="border-t">
                <td class="p-3">{{ $category->id }}</td>

                <td class="p-3 font-semibold">
                    {{ $category->name }}
                </td>

                <td class="p-3 text-gray-600">
                    {{ $category->slug }}
                </td>

                <td class="p-3">
                    @if($category->attributes->count())
                    <div class="flex flex-wrap gap-1">
                        @foreach($category->attributes as $attribute)
                        <span class="bg-gray-200 text-sm px-2 py-1 rounded">
                            {{ $attribute->name }}
                        </span>
                        @endforeach
                    </div>
                    @else
                    <span class="text-gray-400 text-sm">
                        No attributes
                    </span>
                    @endif
                </td>

                <td class="p-3 text-sm text-gray-500">
                    {{ $category->created_at->format('d M Y') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-6 text-center text-gray-500">
                    No categories created yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection