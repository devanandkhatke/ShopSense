<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\AttributeValue;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Ensure product belongs to logged-in seller
     */
    private function authorizeSeller(Product $product)
    {
        $sellerProfileId = auth()->user()->sellerProfile->id;

        abort_if($product->seller_id !== $sellerProfileId, 403);
    }

    public function index()
    {
        $sellerProfileId = auth()->user()->sellerProfile->id;

        $products = Product::where('seller_id', $sellerProfileId)
            ->latest()
            ->get();

        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $sellerProfile = auth()->user()->sellerProfile;
        $store = $sellerProfile->store;

        if (!$store || !$store->is_completed) {
            abort(403, 'Complete store setup first.');
        }

        $categories = Category::with('attributes.values')->get();

        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $sellerProfile = auth()->user()->sellerProfile;
        $store = $sellerProfile->store;

        abort_if(!$store || !$store->is_completed, 403, 'Complete store setup first.');

        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $product = Product::create([
            'seller_id'   => $sellerProfile->id,
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name) . '-' . uniqid(),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'status'      => 'pending',
        ]);

        // ✅ SAFE ATTRIBUTE SYNC
        $attributes = (array) $request->input('attributes', []);
        $attributes = array_filter($attributes, fn($v) => !empty($v));

        if (!empty($attributes)) {
            $product->attributeValues()->sync(array_values($attributes));
        }

        return redirect()
            ->route('seller.products.index')
            ->with('success', 'Product created successfully and sent for approval.');
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

        // ✅ SAFE ATTRIBUTE SYNC
        $attributes = (array) $request->input('attributes', []);
        $attributes = array_filter($attributes, fn($v) => !empty($v));

        if (!empty($attributes)) {
            $product->attributeValues()->sync(array_values($attributes));
        }

        return redirect()
            ->route('seller.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function show(Product $product)
    {
        $this->authorizeSeller($product);

        return view('seller.products.show', compact('product'));
    }
}
