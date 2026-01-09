<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 🔐 IMPORTANT: Check seller profile first
        $profile = $user->sellerProfile;

        if (!$profile) {
            // Safety fallback (should not happen)
            return redirect()->route('seller.apply');
        }

        if ($profile->status === 'pending') {
            return view('seller.pending');
        }

        if ($profile->status === 'rejected') {
            return view('seller.rejected');
        }

        // ✅ Only APPROVED sellers reach here
        $sellerId = $user->id;

        $stats = [
            'total_products' => Product::where('seller_id', $sellerId)->count(),

            'pending_products' => Product::where('seller_id', $sellerId)
                ->where('status', 'pending')
                ->count(),

            'approved_products' => Product::where('seller_id', $sellerId)
                ->where('status', 'approved')
                ->count(),

            'low_stock_products' => Product::where('seller_id', $sellerId)
                ->where('stock', '<=', 5)
                ->count(),

            'total_stock' => Product::where('seller_id', $sellerId)
                ->sum('stock'),
        ];

        return view('seller.dashboard', compact('stats'));
    }
}
