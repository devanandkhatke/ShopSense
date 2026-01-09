<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Featured products (admin-controlled later)
        $featuredProducts = Product::with('primaryImage')
            ->where('status', 'approved')
            ->latest()
            ->take(8)
            ->get();

        // Categories with products
        $categories = Category::with(['products' => function ($query) {
            $query->where('status', 'approved')
                ->with('primaryImage')
                ->take(6);
        }])->get();

        return view('home', compact(
            'featuredProducts',
            'categories'
        ));
    }
}
