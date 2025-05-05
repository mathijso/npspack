<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NpsResponse;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class NpsSubmissionController extends Controller
{
    /**
     * Store a newly created NPS response from the widget.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'site_id' => 'required|uuid|exists:sites,public_id', // Validate the public UUID
            'score' => 'required|integer|min:0|max:10',
            'feedback' => 'nullable|string|max:1000', // Increased max length maybe?
            'ip_address' => 'nullable|ip',
            'fingerprint' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        // Find the site using the public_id
        $site = Site::where('public_id', $validated['site_id'])->firstOrFail();

        // Basic throttling/duplicate check (example: check IP + site + score within last hour)
        // You might want more robust logic here (e.g., using fingerprint)
        $recentSubmission = NpsResponse::where('site_id', $site->id)
            ->where('ip_address', $validated['ip_address'] ?? $request->ip())
            // ->where('score', $validated['score']) // Optional: Allow score change?
            ->where('submitted_at', '>', now()->subHour())
            ->exists();

        if ($recentSubmission && !empty($validated['ip_address'])) {
             return response()->json(['message' => 'Duplicate submission suspected.'], 429); // Too Many Requests
        }

        try {
            NpsResponse::create([
                'site_id' => $site->id, // Use the actual site_id foreign key
                'score' => $validated['score'],
                'feedback' => $validated['feedback'] ?? null,
                'ip_address' => $validated['ip_address'] ?? $request->ip(), // Store request IP if not provided
                'fingerprint' => $validated['fingerprint'] ?? null,
                'tag' => $validated['tag'] ?? null,
                'submitted_at' => now(),
            ]);

            return response()->json(['message' => 'Feedback received. Thank you!'], 201);

        } catch (\Exception $e) {
            // Log the error
            logger()->error('NPS Submission failed', ['error' => $e->getMessage(), 'data' => $validated]);
            return response()->json(['message' => 'An error occurred while saving your feedback.'], 500);
        }
    }
}
