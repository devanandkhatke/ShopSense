<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['seller', 'category']);

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('seller_id')) {
            $query->where('seller_id', $request->seller_id);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        return view('admin.products.index', [
            'products'   => $query->latest()->paginate(20),
            'categories' => \App\Models\Category::all(),
            'sellers'    => \App\Models\User::role('seller')->get(),
        ]);
    }

    public function show(\App\Models\Product $product)
    {
        // Eager load relations for performance
        $product->load([
            'category',
            'seller',
            'images',
            'variants.attributeValues.attribute'
        ]);

        return view('admin.products.show', compact('product'));
    }


    public function approve(Product $product)
    {
        $product->update(['status' => 'approved']);
        return back()->with('success', 'Product approved');
    }

    public function reject(Product $product)
    {
        $product->update(['status' => 'rejected']);
        return back()->with('error', 'Product rejected');
    }
}
