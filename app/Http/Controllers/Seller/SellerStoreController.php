<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerStore;

class SellerStoreController extends Controller
{
    public function edit()
    {
        $profile = auth()->user()->sellerProfile;

        abort_if($profile->status !== 'active', 403);

        $store = $profile->store ?? SellerStore::create([
            'seller_profile_id' => $profile->id
        ]);

        return view('seller.store-setup', compact('store'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'website' => 'nullable|url',
            'whatsapp_number' => 'nullable|digits:10',
            'shipping_method' => 'required',
            'default_tax_rate' => 'required|numeric|min:0|max:28',
        ]);

        $store = auth()->user()->sellerProfile->store;

        $store->update([
            'website' => $request->website,
            'whatsapp_number' => $request->whatsapp_number,
            'shipping_method' => $request->shipping_method,
            'default_tax_rate' => $request->default_tax_rate,
            'is_completed' => true,
        ]);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Store setup completed.');
    }
}
