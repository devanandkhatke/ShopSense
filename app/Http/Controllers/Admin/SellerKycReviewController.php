<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerKyc;
use Illuminate\Support\Facades\DB;

class SellerKycReviewController extends Controller
{
    /**
     * List all submitted KYCs for review
     */
    public function index()
    {
        $kycs = SellerKyc::with('sellerProfile.user')
            ->whereIn('status', ['submitted', 'pending'])
            ->latest()
            ->get();

        return view('admin.kyc.index', compact('kycs'));
    }

    /**
     * Show single seller KYC
     */
    public function show($sellerId)
    {
        $kyc = SellerKyc::where('seller_profile_id', $sellerId)->firstOrFail();
        return view('admin.kyc.show', compact('kyc'));
    }

    /**
     * Approve seller KYC & activate seller
     */
    public function approve(SellerKyc $kyc)
    {
        DB::transaction(function () use ($kyc) {

            // 1. Verify KYC
            $kyc->update([
                'status' => 'verified',
                'verified_at' => now(),
            ]);

            // 2. Activate seller
            $sellerProfile = $kyc->sellerProfile;

            $sellerProfile->update([
                'status' => 'active',
                'activated_at' => now(),
            ]);

            // 3. Mark onboarding complete
            $sellerProfile->user->update([
                'seller_onboarding_completed' => true,
            ]);
        });

        return redirect()
            ->route('admin.sellers.index')
            ->with('success', 'KYC approved. Seller activated.');
    }
}
