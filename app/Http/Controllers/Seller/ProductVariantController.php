<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductVariantController extends Controller
{
    private function authorizeSeller(Product $product)
    {
        $sellerProfileId = auth()->user()->sellerProfile->id;
        abort_if($product->seller_id !== $sellerProfileId, 403);
    }

    public function index(Product $product)
    {
        $this->authorizeSeller($product);
        $product->load('variants.attributeValues.attribute');

        return view('seller.variants.index', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $this->authorizeSeller($product);

        $request->validate([
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'attributes' => 'required|array',
        ]);

        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'sku' => strtoupper(Str::random(8)),
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        $variant->attributeValues()->sync($request->attributes);

        return back()->with('success', 'Variant created');
    }
}
