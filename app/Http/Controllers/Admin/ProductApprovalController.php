<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApprovalController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'pending')->get();
        return view('admin.products.index', compact('products'));
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
