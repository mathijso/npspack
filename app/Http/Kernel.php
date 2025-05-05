<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        // Lemon Squeezy Middleware (Keep if needed for webhooks, etc.)
        'lemon-squeezy' => \LemonSqueezy\Laravel\Http\Middleware\VerifyWebhookSignature::class,
        // Remove or comment out the old subscription middleware
        // 'subscribed' => \App\Http\Middleware\EnsureUserIsSubscribed::class,
    ];
} 