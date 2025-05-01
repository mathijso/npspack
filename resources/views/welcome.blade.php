<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>🎯 NPSpack - Collect Net Promoter Scores in under a minute</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white dark:bg-neutral-950 text-neutral-800 dark:text-neutral-200">

        <div class="flex flex-col min-h-screen">

            <header class="w-full border-b border-neutral-200 dark:border-neutral-800 sticky top-0 bg-white/80 dark:bg-neutral-950/80 backdrop-blur-sm z-20">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex h-16 items-center justify-between">
                    <div class="flex items-center gap-2">
                         {{-- Placeholder for Logo if needed --}}
                        <a href="/" class="text-lg font-semibold">🎯 NPS Pack</a>
                    </div>

            @if (Route::has('login'))
                        <nav class="-my-2 flex items-center justify-end gap-2">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                                    class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors"
                        >
                                    Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors"
                                >
                                    Log in
                                </a>
                        
                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-950 transition-colors"
                                    >
                            Get started
                        </a>
                                @endif
                    @endauth
                </nav>
            @endif
                </div>
        </header>
        
            <main class="flex-grow">
            {{-- Hero Section --}}
                <section class="relative overflow-hidden bg-gradient-to-b from-white to-neutral-100 dark:from-neutral-950 dark:to-neutral-900 py-20 sm:py-28 lg:py-32">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-5xl lg:text-6xl mb-6">
                            Drop a script. Get real feedback. <span class="text-indigo-500">🎯</span>
                        </h1>
                        <p class="text-lg text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto mb-10">
                            Start collecting Net Promoter Scores in under a minute. No integrations, no bloat. Just simple, actionable feedback.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-12">
                             {{-- Note: Added dark mode styles and consistent look --}}
                             <button type="button"
                                class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-900 transition-colors">
                                Copy Snippet
                    </button>
                </div>
                <div class="flex justify-center">
                            <pre class="bg-neutral-100 dark:bg-neutral-800/50 border border-neutral-200 dark:border-neutral-700 text-left p-4 rounded-lg shadow-inner overflow-x-auto w-full max-w-md"><code class="text-sm text-neutral-700 dark:text-neutral-300 block whitespace-pre-wrap">&lt;script src="https://cdn.npspack.com/widget.js" data-id="YOUR_UNIQUE_ID"&gt;&lt;/script&gt;</code></pre>
                        </div>
                </div>
            </section>
        
            {{-- "Why NPS?" Section --}}
                <section class="bg-white dark:bg-neutral-950 py-16 sm:py-24">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl mb-12">Why NPS? It's simple.</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 lg:gap-16 max-w-5xl mx-auto">
                            <div class="flex flex-col items-center p-6 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-900 transition-colors">
                                <div class="text-5xl mb-5">📊</div>
                                <h3 class="text-xl font-semibold mb-3">Gauge Loyalty</h3>
                                <p class="text-neutral-600 dark:text-neutral-400">Understand customer satisfaction and predict future growth potential.</p>
                            </div>
                            <div class="flex flex-col items-center p-6 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-900 transition-colors">
                                <div class="text-5xl mb-5">💡</div>
                                <h3 class="text-xl font-semibold mb-3">Identify Issues</h3>
                                <p class="text-neutral-600 dark:text-neutral-400">Quickly spot unhappy customers (Detractors) and address their concerns proactively.</p>
                        </div>
                            <div class="flex flex-col items-center p-6 rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-900 transition-colors">
                                <div class="text-5xl mb-5">📈</div>
                                <h3 class="text-xl font-semibold mb-3">Drive Improvement</h3>
                                <p class="text-neutral-600 dark:text-neutral-400">Use direct feedback to make your product or service better, step by step.</p>
                        </div>
                    </div>
                </div>
            </section>
        
            {{-- Features Section --}}
                <section class="bg-neutral-50 dark:bg-neutral-900 py-16 sm:py-24">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <h2 class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl text-center mb-12">Packed with essentials. No fluff.</h2>
                        <div class="max-w-2xl mx-auto space-y-5">
                            <div class="flex items-start gap-3 p-4 border border-neutral-200 dark:border-neutral-800 rounded-lg bg-white dark:bg-neutral-950">
                                <span class="text-green-500 mt-1 shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" /></svg>
                                </span>
                                <div>
                                    <h4 class="font-medium">Simple Script Integration</h4>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Just copy and paste one line of code.</p>
                                </div>
                            </div>
                             <div class="flex items-start gap-3 p-4 border border-neutral-200 dark:border-neutral-800 rounded-lg bg-white dark:bg-neutral-950">
                                <span class="text-green-500 mt-1 shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" /></svg>
                                </span>
                                <div>
                                    <h4 class="font-medium">Customizable Widget</h4>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Match the look and feel of your brand (Pro).</p>
                                </div>
                            </div>
                             <div class="flex items-start gap-3 p-4 border border-neutral-200 dark:border-neutral-800 rounded-lg bg-white dark:bg-neutral-950">
                                <span class="text-green-500 mt-1 shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" /></svg>
                                </span>
                                <div>
                                    <h4 class="font-medium">Real-time Dashboard</h4>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">See your NPS score and feedback instantly.</p>
                                </div>
                            </div>
                             <div class="flex items-start gap-3 p-4 border border-neutral-200 dark:border-neutral-800 rounded-lg bg-white dark:bg-neutral-950">
                                <span class="text-green-500 mt-1 shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" /></svg>
                                </span>
                                <div>
                                    <h4 class="font-medium">No Complex Setup</h4>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">No databases, no server config needed.</p>
                                </div>
                            </div>
                             <div class="flex items-start gap-3 p-4 border border-neutral-200 dark:border-neutral-800 rounded-lg bg-white dark:bg-neutral-950">
                                <span class="text-yellow-500 mt-1 shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A.75.75 0 0 0 10 14a1 1 0 1 0 0-2h-.253a.25.25 0 0 1-.244-.304l.459-2.066A.75.75 0 0 0 9 9Z" clip-rule="evenodd" /></svg>
                                </span>
                                <div>
                                    <h4 class="font-medium">Missing a Feature?</h4>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Let us know! We're actively developing.</p>
                                </div>
                            </div>
                        </div>
                </div>
            </section>
        
            {{-- Pricing Section --}}
                <section class="bg-white dark:bg-neutral-950 py-16 sm:py-24">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl mb-12">One-time payment. Unlimited feedback.</h2>
                        <div class="flex flex-col lg:flex-row justify-center items-stretch gap-8 max-w-4xl mx-auto">
                            {{-- Pricing Card 1: Basic --}}
                            <div class="border border-neutral-200 dark:border-neutral-800 rounded-lg p-8 flex flex-col flex-1 w-full lg:w-auto">
                            <h3 class="text-2xl font-semibold mb-4">Basic Pack</h3>
                                <p class="text-4xl font-bold mb-1"><span class="text-neutral-500 dark:text-neutral-400">$</span>9</p>
                                <p class="text-sm font-normal text-neutral-500 dark:text-neutral-400 mb-6">one-time payment</p>
                                <ul class="text-left space-y-3 mb-8 text-neutral-600 dark:text-neutral-300 flex-grow">
                                    <li class="flex items-center gap-2"><span class="text-green-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" /></svg></span> Unlimited responses</li>
                                    <li class="flex items-center gap-2"><span class="text-green-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" /></svg></span> 1 Tag per site</li>
                                    <li class="flex items-center gap-2"><span class="text-green-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" /></svg></span> 1 Site </li>
                                    
                            </ul>
                                <button type="button"
                                    class="mt-auto w-full inline-flex items-center justify-center rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 px-5 py-2.5 text-sm font-medium text-neutral-700 dark:text-neutral-300 shadow-sm hover:bg-neutral-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-950 transition-colors">
                                    Get Basic
                                </button>
                        </div>
                            {{-- Pricing Card 2: Pro --}}
                            <div class="border-2 border-indigo-600 dark:border-indigo-500 rounded-lg p-8 flex flex-col relative flex-1 w-full lg:w-auto shadow-lg dark:shadow-indigo-900/20">
                                <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">Most Popular</span>
                            <h3 class="text-2xl font-semibold mb-4">Pro Pack</h3>
                                <p class="text-4xl font-bold mb-1"><span class="text-neutral-500 dark:text-neutral-400">$</span>19</p>
                                <p class="text-sm font-normal text-neutral-500 dark:text-neutral-400 mb-6">one-time payment</p>
                                <ul class="text-left space-y-3 mb-8 text-neutral-600 dark:text-neutral-300 flex-grow">
                                    <li class="flex items-center gap-2"><span class="text-green-500"><svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd"
                                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                                                    clip-rule="evenodd" />
                                            </svg></span> Unlimited responses</li>
                                    <li class="flex items-center gap-2"><span class="text-green-500"><svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd"
                                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                                                    clip-rule="evenodd" />
                                            </svg></span> 1 Tag per site</li>
                                    <li class="flex items-center gap-2"><span class="text-green-500"><svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd"
                                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                                                    clip-rule="evenodd" />
                                            </svg></span> Unlimited Sites </li>
                            </ul>
                                <button type="button"
                                    class="mt-auto w-full inline-flex items-center justify-center rounded-md bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-950 transition-colors">
                                    Get Pro
                                </button>
                            </div>
                    </div>
                </div>
            </section>
        
            {{-- CTA Section --}}
                <section class="bg-gradient-to-b from-neutral-50 to-white dark:from-neutral-900 dark:to-neutral-950 py-20 sm:py-28">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl mb-5">Ready to get real feedback?</h2>
                        <p class="text-lg text-neutral-600 dark:text-neutral-400 max-w-xl mx-auto mb-10">Drop the snippet, get the scores. It's that easy to start understanding your customers better.</p>
                        <button type="button"
                            class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-8 py-3 text-lg font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-950 transition-colors">
                            Start Getting Feedback Now
                </button>
                    </div>
            </section>
        
            </main>

            {{-- Footer --}}
            <footer class="border-t border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center">
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                        &copy; {{ date('Y') }} NPSpack. All rights reserved. |
                        <a href="{{ route('privacy') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Privacy Policy</a> |
                        <a href="{{ route('terms') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Terms of Service</a>
                    </p>
                    {{-- Optional: Add social links or other footer content here --}}
                </div>
            </footer>
        
        </div> {{-- End min-h-screen flex flex-col --}}

    </body>
</html>
