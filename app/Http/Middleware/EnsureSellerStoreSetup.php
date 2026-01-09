<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSellerStoreSetup
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || !$user->hasRole('seller')) {
            abort(403, 'Unauthorized.');
        }

        $profile = $user->sellerProfile;

        if (!$profile || $profile->status !== 'active') {
            return redirect()
                ->route('seller.kyc.edit')
                ->with('warning', 'Complete KYC first.');
        }

        if (!$profile->store || !$profile->store->is_completed) {
            return redirect()
                ->route('seller.store.edit')
                ->with('warning', 'Complete store setup to continue.');
        }

        return $next($request);
    }
}
