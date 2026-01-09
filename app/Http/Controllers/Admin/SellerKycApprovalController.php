<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerProfile;
use Illuminate\Http\Request;

class KycApprovalController extends Controller
{
    public function index()
    {
        $pendingKycSellers = SellerProfile::where('status', 'kyc_pending')->get();
        return view('admin.kyc_approval.index', compact('pendingKycSellers'));
    }

    public function show($sellerProfileId)
    {
        $sellerProfile = SellerProfile::findOrFail($sellerProfileId);
        return view('admin.kyc_approval.show', compact('sellerProfile'));
    }

    public function approve(SellerProfile $seller)
    {
        $seller->update([
            'application_status' => 'approved',
        ]);

        return back()->with('success', 'Seller application approved.');
    }


    public function reject($sellerProfileId)
    {
        $sellerProfile = \App\Models\SellerProfile::findOrFail($sellerProfileId);
        $sellerProfile->update(['status' => 'kyc_rejected']);
        $sellerProfile->kyc->update(['status' => 'rejected']);
        // Optionally notify seller
        return back()->with('error', 'Seller KYC rejected.');
    }
}