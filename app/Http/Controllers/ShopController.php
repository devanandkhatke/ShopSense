<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::with('primaryImage')
            ->where('status', 'approved')
            ->latest()
            ->paginate(12);

        return view('shop.index', compact('products'));
    }

    public function show(Product $product)
    {
        abort_if($product->status !== 'approved', 404);

        $product->load('images', 'category');

        return view('shop.show', compact('product'));
    }
}
