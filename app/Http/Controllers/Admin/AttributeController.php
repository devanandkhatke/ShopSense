<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        return view('admin.attributes.index', [
            'attributes' => Attribute::with('values', 'categories')->get(),
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        Attribute::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Attribute created');
    }

    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit', [
            'attribute' => $attribute->load('values', 'categories'),
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'categories' => 'array',
        ]);

        $attribute->update([
            'name' => $request->name,
        ]);

        $attribute->categories()->sync($request->categories ?? []);

        return redirect()
            ->route('admin.attributes.index')
            ->with('success', 'Attribute updated');
    }
}
