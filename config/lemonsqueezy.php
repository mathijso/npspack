<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Lemon Squeezy Variant IDs
    |--------------------------------------------------------------------------
    |
    | Define the variant IDs for your different one-time purchase products.
    | These IDs are used to check if a user has purchased a specific package.
    | Make sure to add the corresponding environment variables to your .env file.
    |
    */

    'variants' => [
        'basic' => env('LEMONSQUEEZY_BASIC_VARIANT_ID'),
        'pro' => env('LEMONSQUEEZY_PRO_VARIANT_ID'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Other Lemon Squeezy Settings (Add as needed)
    |--------------------------------------------------------------------------
    |
    | You might have other settings published by the package here.
    | Keep them or add more configuration specific to your integration.
    |
    */

    // Add other Lemon Squeezy config keys here if they exist or are needed.
    // For example, keys published by `php artisan vendor:publish --tag=lemonsqueezy-config`
    // might include 'store', 'api_key', 'signing_secret', 'models', etc.
    // Ensure you don't overwrite essential keys if they were published previously.

]; 