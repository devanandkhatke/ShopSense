<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(Request $request, Product $product)
    {
        // Ownership check
        abort_if($product->seller_id !== auth()->id(), 403);

        $request->validate([
            'image' => 'required|image|max:2048', // 2MB
        ]);

        $path = $request->file('image')->store('products', 'public');

        // If no primary image exists, make this primary
        $isPrimary = !$product->images()->exists();

        ProductImage::create([
            'product_id' => $product->id,
            'path' => $path,
            'is_primary' => $isPrimary,
        ]);

        return back()->with('success', 'Image uploaded');
    }

    public function destroy(ProductImage $image)
    {
        abort_if($image->product->seller_id !== auth()->id(), 403);

        \Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('success', 'Image deleted');
    }
}
