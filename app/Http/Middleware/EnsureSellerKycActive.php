<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSellerKycActive
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Must be logged in seller
        if (!$user || !$user->hasRole('seller')) {
            abort(403, 'Unauthorized.');
        }

        // Must have seller profile
        if (!$user->sellerProfile) {
            abort(403, 'Seller profile not found.');
        }

        // Enforce KYC completion
        if (!$user->sellerProfile->isActive()) {
            return redirect()
                ->route('seller.kyc.edit')
                ->with('warning', 'Complete KYC to unlock seller features.');
        }

        return $next($request);
    }
}
