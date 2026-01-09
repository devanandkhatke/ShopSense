<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerPayout;
use Illuminate\Support\Facades\DB;

class PayoutController extends Controller
{
    public function index()
    {
        $payouts = SellerPayout::where('status', 'requested')->get();
        return view('admin.payouts.index', compact('payouts'));
    }

    public function markPaid(SellerPayout $payout)
    {
        DB::transaction(function () use ($payout) {
            $payout->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            $wallet = $payout->sellerProfile->wallet;
            $wallet->decrement('pending_balance', $payout->amount);
        });

        return back()->with('success', 'Payout marked as paid.');
    }
}
