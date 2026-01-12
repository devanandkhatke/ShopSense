<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\SellerStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerStoreController extends Controller
{
    public function edit()
    {
        $sellerProfile = auth()->user()->sellerProfile;

        $store = $sellerProfile->store ?? SellerStore::create([
            'seller_profile_id' => $sellerProfile->id,
        ]);

        return view('seller.store.edit', compact('store'));
    }

    public function update(Request $request)
    {
        $sellerProfile = auth()->user()->sellerProfile;
        $store = $sellerProfile->store;

        $validated = $request->validate([
            'store_logo'       => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'website'          => 'nullable|url|max:255',
            'whatsapp_number'  => 'required|string|max:20',
            'shipping_method'  => 'required|in:self_ship,platform_ship',
            'default_tax_rate' => 'required|numeric|min:0|max:100',
        ]);

        if ($request->hasFile('store_logo')) {
            if ($store->store_logo) {
                Storage::disk('public')->delete($store->store_logo);
            }

            $validated['store_logo'] = $request
                ->file('store_logo')
                ->store('store-logos', 'public');
        }

        $validated['is_completed'] = true;

        $store->update($validated);

        return redirect()
            ->route('seller.dashboard')
            ->with('success', 'Store profile completed successfully.');
    }
}
