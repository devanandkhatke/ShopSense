<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerPayout;
use Illuminate\Support\Facades\DB;

class PayoutController extends Controller
{
    public function index()
    {
        $profile = auth()->user()->sellerProfile;

        abort_if(!$profile || $profile->status !== 'active', 403);

        $wallet = $profile->wallet ?? $profile->wallet()->create([
            'available_balance' => 0,
            'pending_balance' => 0,
        ]);

        return view('seller.payouts', compact('wallet'));
    }


    public function request(Request $request)
    {
        $profile = auth()->user()->sellerProfile;
        $wallet = $profile->wallet;

        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        abort_if($request->amount > $wallet->available_balance, 403);

        DB::transaction(function () use ($profile, $wallet, $request) {

            SellerPayout::create([
                'seller_profile_id' => $profile->id,
                'amount' => $request->amount,
            ]);

            $wallet->decrement('available_balance', $request->amount);
            $wallet->increment('pending_balance', $request->amount);
        });

        return back()->with('success', 'Payout request submitted.');
    }
}
