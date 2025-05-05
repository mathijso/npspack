<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasPurchasedPackage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Check if user is authenticated and NOT an admin
        if ($user && !$user->is_admin) {
            // Get variant IDs from config
            $basicVariantId = config('lemonsqueezy.variants.basic');
            $proVariantId = config('lemonsqueezy.variants.pro');

            // Check if the user has purchased either the basic or pro variant
            $hasBasic = $basicVariantId && $user->hasPurchasedVariant($basicVariantId);
            $hasPro = $proVariantId && $user->hasPurchasedVariant($proVariantId);

            // If user has not purchased either package, redirect them
            if (!$hasBasic && !$hasPro) {
                // Optionally flash a message to explain the redirect
                return redirect()->route('subscribe')->with('warning', 'Je hebt een betaald pakket nodig om toegang te krijgen tot deze sectie.');
            }
        }

        // If user is admin, guest, or has purchased a package, continue
        return $next($request);
    }
}
