<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function store(Request $request, Attribute $attribute)
    {
        $request->validate([
            'value' => 'required|string|max:100',
        ]);

        $attribute->values()->create([
            'value' => $request->value,
        ]);

        return back()->with('success', 'Value added');
    }

    public function destroy(AttributeValue $value)
    {
        $value->delete();
        return back()->with('success', 'Value deleted');
    }
}
