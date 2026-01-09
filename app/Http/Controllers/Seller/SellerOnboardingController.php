<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\SellerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SellerOnboardingController extends Controller
{
    public function create()
    {
        $profile = auth()->user()->sellerProfile;

        if ($profile) {
            if ($profile->status === 'approved') {
                return redirect()->route('seller.dashboard');
            }

            return redirect()->route('seller.pending');
        }

        return view('seller.apply');
    }


    public function store(Request $request)
    {

        if (!auth()->check()) {
            abort(403, 'Login required to apply as seller.');
        }
        $request->validate([
            'business_name' => 'required|string|max:255',
            'store_display_name' => 'required|string|max:255',
            'business_type' => 'required',
            'industry' => 'required',
            'gst_number' => 'required|size:15|unique:seller_profiles,gst_number',
            'pan_number' => 'nullable',

            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|digits:10|unique:seller_profiles,contact_phone',

            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required|digits:6',
        ]);

        DB::transaction(function () use ($request) {

            SellerProfile::create([
                'user_id' => auth()->id(),
                'business_name' => $request->business_name,
                'store_display_name' => $request->store_display_name,
                'business_type' => $request->business_type,
                'industry' => $request->industry,

                'store_name' => $request->store_display_name,
                'store_slug' => Str::slug($request->store_display_name),
                'store_description' => $request->store_description,

                'gst_number' => $request->gst_number,
                'pan_number' => $request->pan_number,

                'contact_name' => $request->contact_name,
                'contact_phone' => $request->contact_phone,

                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,

                'status' => 'pending',
            ]);
        });

        return redirect()->route('seller.pending')
            ->with('success', 'Application submitted. Await admin approval.');
    }
}
