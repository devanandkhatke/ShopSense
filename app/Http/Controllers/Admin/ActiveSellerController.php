<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerProfile;

class ActiveSellerController extends Controller
{
    public function index()
    {
        $sellers = SellerProfile::where('status', 'active')->latest()->get();
        return view('admin.sellers.active', compact('sellers'));
    }
}
