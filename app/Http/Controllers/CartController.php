<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $items = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('cart.index', compact('items'));
    }

    public function store(Product $product)
    {
        CartItem::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => \DB::raw('quantity + 1'),
            ]
        );

        return back()->with('success', 'Added to cart');
    }

    public function destroy(CartItem $cartItem)
    {
        abort_if($cartItem->user_id !== auth()->id(), 403);

        $cartItem->delete();

        return back()->with('success', 'Item removed');
    }
}
