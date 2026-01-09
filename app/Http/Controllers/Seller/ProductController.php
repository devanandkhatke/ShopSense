<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private function authorizeSeller(Product $product)
    {
        abort_if($product->seller_id !== auth()->id(), 403);
    }

    public function index()
    {
        $products = Product::where('seller_id', auth()->id())
            ->latest()
            ->get();

        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $store = auth()->user()->sellerProfile->store;

        if (!$store || !$store->is_completed) {
            abort(403, 'Complete store setup first.');
        }

        $categories = Category::with('attributes.values')->get();

        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $store = auth()->user()->sellerProfile->store;

        if (!$store || !$store->is_completed) {
            abort(403, 'Complete store setup first.');
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $product = Product::create([
            'seller_id'   => auth()->id(),
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name) . '-' . uniqid(),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'status'      => 'pending',
        ]);

        // Attach attribute values (if any)
        if ($request->filled('attributes')) {
            $product->attributeValues()
                ->sync(array_values($request->attributes));
        }

        return redirect()
            ->route('seller.products.show', $product)
            ->with('success', 'Product created successfully');
    }

    public function show(Product $product)
    {
        $this->authorizeSeller($product);

        $product->load('images', 'attributeValues.attribute');

        return view('seller.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorizeSeller($product);

        $categories = Category::with('attributes.values')->get();

        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeSeller($product);

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name) . '-' . $product->id,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
        ]);

        if ($request->filled('attributes')) {
            $product->attributeValues()
                ->sync(array_values($request->attributes));
        }

        return redirect()
            ->route('seller.products.show', $product)
            ->with('success', 'Product updated successfully');
    }
}
