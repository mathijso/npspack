<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Site Limits
    |--------------------------------------------------------------------------
    |
    | Define limits related to site creation and usage based on user packages.
    |
    */

    'basic_max_sites' => env('SITE_LIMIT_BASIC', 1), // Max sites for basic package

    // Add other limits here if needed in the future
    // 'pro_max_sites' => env('SITE_LIMIT_PRO', 100), // Example if Pro wasn't unlimited

]; 