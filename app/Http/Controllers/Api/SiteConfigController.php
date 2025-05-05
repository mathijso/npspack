<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SiteConfigController extends Controller
{
    /**
     * Display the public configuration for a specific site.
     *
     * @param string $public_id The public UUID of the site.
     * @return JsonResponse
     */
    public function show(string $public_id): JsonResponse
    {
        $site = Site::where('public_id', $public_id)
                    ->select('allowed_paths') // Only select necessary public config
                    ->first();

        if (!$site) {
            return response()->json(['message' => 'Site not found.'], 404);
        }

        // Return the allowed_paths (which will be null or an array due to casting)
        return response()->json([
            'allowed_paths' => $site->allowed_paths,
        ]);
    }
}
