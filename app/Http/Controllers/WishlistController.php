<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $items = Wishlist::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('wishlist.index', compact('items'));
    }

    public function store(Product $product)
    {
        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Added to wishlist');
    }

    public function destroy(Wishlist $wishlist)
    {
        abort_if($wishlist->user_id !== auth()->id(), 403);

        $wishlist->delete();

        return back()->with('success', 'Removed from wishlist');
    }
}
