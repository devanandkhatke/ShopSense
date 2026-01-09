<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerProfile;

class SellerApprovalController extends Controller
{
    /**
     * Show seller applications (NOT active sellers)
     */
    public function index()
    {
        $sellers = SellerProfile::with('user')
            ->whereIn('status', [
                'pending',
                'approved',
                'kyc_pending',
                'rejected'
            ])
            ->latest()
            ->get();

        return view('admin.sellers.index', compact('sellers'));
    }

    /**
     * Approve seller application (one-time)
     */
    public function approve(SellerProfile $seller)
    {
        if ($seller->status !== 'pending') {
            return back();
        }

        $seller->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Seller application approved.');
    }

    /**
     * Reject seller application
     */
    public function reject(SellerProfile $seller)
    {
        $seller->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Seller application rejected.');
    }
}
