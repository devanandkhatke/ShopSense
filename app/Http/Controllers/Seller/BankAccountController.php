<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function edit()
    {
        $profile = auth()->user()->sellerProfile;
        abort_if($profile->status !== 'active', 403);

        $bank = $profile->bankAccount;

        return view('seller.bank', compact('bank'));
    }

    public function update(Request $request)
    {
        $profile = auth()->user()->sellerProfile;

        $request->validate([
            'account_holder_name' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required',
        ]);

        $profile->bankAccount()->updateOrCreate([], $request->only([
            'account_holder_name',
            'bank_name',
            'account_number',
            'ifsc_code',
        ]));

        return back()->with('success', 'Bank details saved. Await verification.');
    }
}
