<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\SellerProfile;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),

            'total_sellers' => User::role('seller')->count(),

            'pending_sellers' => SellerProfile::where('status', 'pending')->count(),

            'total_products' => Product::count(),

            'pending_products' => Product::where('status', 'pending')->count(),

            'approved_products' => Product::where('status', 'approved')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
