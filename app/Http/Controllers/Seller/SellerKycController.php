<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\SellerKyc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerKycController extends Controller
{
    public function edit()
    {
        $sellerProfile = auth()->user()->sellerProfile;

        abort_unless($sellerProfile, 403);

        $kyc = $sellerProfile->kyc ?? SellerKyc::create([
            'seller_profile_id' => $sellerProfile->id,
            'status' => 'draft',
        ]);

        return view('seller.kyc', compact('kyc'));
    }

    public function update(Request $request)
    {
        $sellerProfile = auth()->user()->sellerProfile;
        abort_unless($sellerProfile, 403);

        $request->validate([
            'gst_certificate' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'business_registration_doc' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'id_proof' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'cancelled_cheque' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $kyc = $sellerProfile->kyc;

        foreach (
            [
                'gst_certificate',
                'business_registration_doc',
                'id_proof',
                'cancelled_cheque'
            ] as $doc
        ) {

            if ($request->hasFile($doc)) {
                $path = $request->file($doc)
                    ->store("kyc/{$sellerProfile->id}", 'private');
                $kyc->$doc = $path;
            }
        }

        $kyc->update(['status' => 'submitted']);
        $sellerProfile->update(['status' => 'kyc_pending']);

        return back()->with('success', 'KYC documents submitted successfully.');
    }
}
