<x-layouts.app title="Choose a Subscription">
    <div class="container px-4 mx-auto mt-12 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="mb-6 text-2xl font-semibold text-center text-gray-900 dark:text-gray-100">Choose Your Subscription</h1>

            @if (session('warning'))
                <div class="p-4 mb-6 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-900 dark:text-yellow-300" role="alert">
                    {{ session('warning') }}
                </div>
            @endif

            <div class="grid gap-6 md:grid-cols-2">
                {{-- Basic Plan --}}
                @php
                    // Gebruik variant ID uit config
                    $basicVariantId = config('lemonsqueezy.variants.basic');
                    $currentUser = Auth::user(); // Keep user object for less repetition
                    
                    // Use subscribe() method and 'default' for the type
                    $basicCheckout = $currentUser->subscribe($basicVariantId, 'default', [
                        'checkout_data' => [
                            'email' => $currentUser->email, // Pre-fill email
                            'name' => $currentUser->name,   // Pre-fill name
                             // Voeg custom data toe die je terug wilt zien in webhooks
                            'custom' => [
                                'user_id' => (string) $currentUser->id, // Use $currentUser->id
                            ],
                        ]
                    ]);
                    $basicCheckoutUrl = $basicCheckout->url(); // Get URL from Checkout object
                @endphp
                <div class="p-6 border border-gray-200 rounded-lg shadow dark:border-gray-700">
                    <h2 class="mb-3 text-xl font-semibold dark:text-white">Basic</h2>
                    <p class="mb-4 text-gray-600 dark:text-gray-400">Start with basic functionality. Maximum 1 site.</p>
                    {{-- Voeg hier prijs info toe indien relevant --}}
                    <a href="{{ $basicCheckoutUrl }}"
                       class="inline-block w-full px-4 py-2 font-medium text-center text-white bg-gray-500 rounded-md hover:bg-gray-600">
                        Choose Basic
                    </a>
                </div>

                {{-- Pro Plan --}}
                @php
                    // Gebruik variant ID uit config
                    $proVariantId = config('lemonsqueezy.variants.pro');
                    
                    // Use subscribe() method and 'default' for the type
                    $proCheckout = $currentUser->subscribe($proVariantId, 'default', [
                        'checkout_data' => [
                            'email' => $currentUser->email, 
                            'name' => $currentUser->name,  
                            'custom' => [
                                'user_id' => (string) $currentUser->id, // Use $currentUser->id
                            ],
                        ]
                    ]);
                     $proCheckoutUrl = $proCheckout->url(); // Get URL from Checkout object
                @endphp
                <div class="p-6 border border-indigo-500 rounded-lg shadow dark:border-indigo-600">
                     <h2 class="mb-3 text-xl font-semibold dark:text-white">Pro</h2>
                    <p class="mb-4 text-gray-600 dark:text-gray-400">Unlimited sites and all features.</p>
                     {{-- Voeg hier prijs info toe --}}
                    <a href="{{ $proCheckoutUrl }}"
                       class="inline-block w-full px-4 py-2 font-medium text-center text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                        Choose Pro
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app> 