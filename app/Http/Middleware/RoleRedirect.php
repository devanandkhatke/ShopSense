<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleRedirect
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->hasRole('super-admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('seller')) {
            return redirect()->route('seller.dashboard');
        }

        if ($user->hasRole('customer')) {
            return redirect()->route('home');
        }

        abort(403, 'Role not assigned.');
    }
}
