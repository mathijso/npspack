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

        <header
            class="sticky top-0 z-20 w-full border-b border-neutral-200 dark:border-neutral-800 bg-white/80 dark:bg-neutral-950/80 backdrop-blur-sm">
            <div class="container flex items-center justify-between h-16 px-4 mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center gap-2">
                    {{-- Placeholder for Logo if needed --}}
                    <a href="/" class="text-lg font-semibold">🎯 NPS Pack</a>
                </div>

                @if (Route::has('login'))
                    <nav class="flex items-center justify-end gap-2 -my-2">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors rounded-md text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors rounded-md text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white transition-colors bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-950">
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
            <section
                class="relative py-20 overflow-hidden bg-gradient-to-b from-white to-neutral-100 dark:from-neutral-950 dark:to-neutral-900 sm:py-28 lg:py-32">
                <div class="container px-4 mx-auto text-center sm:px-6 lg:px-8">
                    <h1
                        class="mb-6 text-4xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-5xl lg:text-6xl">
                        Drop a script. Get real feedback. <span class="text-indigo-500">🎯</span>
                    </h1>
                    <p class="max-w-2xl mx-auto mb-10 text-lg text-neutral-600 dark:text-neutral-400">
                        Start collecting Net Promoter Scores in under a minute. No integrations, no bloat. Just simple,
                        actionable feedback.
                    </p>
                    <div class="flex flex-col items-center justify-center gap-4 mb-12 sm:flex-row">
                        {{-- Note: Added dark mode styles and consistent look --}}
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white transition-colors bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-900">
                            Copy Snippet
                        </a>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-full max-w-md">
                            <div class="mb-2 text-sm text-neutral-600 dark:text-neutral-400">Example snippet to copy:
                            </div>
                            <pre
                                class="w-full p-4 overflow-x-auto text-left border rounded-lg shadow-inner bg-neutral-100 dark:bg-neutral-800/50 border-neutral-200 dark:border-neutral-700"><code class="block text-sm whitespace-pre-wrap text-neutral-700 dark:text-neutral-300">&lt;script src="https://cdn.npspack.com/widget.js" data-id="YOUR_UNIQUE_ID"&gt;&lt;/script&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </section>

            {{-- "Why NPS?" Section --}}
            <section class="py-16 bg-white dark:bg-neutral-950 sm:py-24">
                <div class="container px-4 mx-auto text-center sm:px-6 lg:px-8">
                    <h2 class="mb-12 text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl">Why
                        NPS?
                        Because feedback fuels growth.</h2>
                    <div class="grid max-w-5xl grid-cols-1 gap-10 mx-auto md:grid-cols-3 lg:gap-16">

                        <div
                            class="flex flex-col items-center p-6 transition-colors rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-900">
                            <div class="mb-5 text-5xl">📊</div>
                            <h3 class="mb-3 text-xl font-semibold">Spot Your Superfans</h3>
                            <p class="text-neutral-600 dark:text-neutral-400">
                                Want to know who’s loving what you’ve built? NPS highlights your biggest fans—so you can
                                learn from
                                them, lean into what works, and turn good into unforgettable.
                            </p>
                        </div>

                        <div
                            class="flex flex-col items-center p-6 transition-colors rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-900">
                            <div class="mb-5 text-5xl">💡</div>
                            <h3 class="mb-3 text-xl font-semibold">Catch Cracks Early</h3>
                            <p class="text-neutral-600 dark:text-neutral-400">
                                Unhappy users don’t always shout. NPS helps you catch silent frustration before it
                                becomes churn—so
                                you can fix friction fast and keep trust strong.
                            </p>
                        </div>

                        <div
                            class="flex flex-col items-center p-6 transition-colors rounded-lg hover:bg-neutral-50 dark:hover:bg-neutral-900">
                            <div class="mb-5 text-5xl">🚀</div>
                            <h3 class="mb-3 text-xl font-semibold">Build What People Brag About</h3>
                            <p class="text-neutral-600 dark:text-neutral-400">
                                Every NPS score is a roadmap. Use raw, honest feedback to fine-tune your product, wow
                                your users,
                                and build the kind of experience people can’t stop talking about.
                            </p>
                        </div>

                    </div>
                </div>
            </section>


            {{-- Features Section --}}
            <section class="py-16 bg-neutral-50 dark:bg-neutral-900 sm:py-24">
                <div class="container px-4 mx-auto sm:px-6 lg:px-8">
                    <h2
                        class="mb-12 text-3xl font-bold tracking-tight text-center text-neutral-900 dark:text-white sm:text-4xl">
                        Packed with essentials. No fluff.</h2>
                    <div class="max-w-2xl mx-auto space-y-5">
                        <div
                            class="flex items-start gap-3 p-4 transition-all duration-300 transform bg-white border rounded-lg border-neutral-200 dark:border-neutral-800 dark:bg-neutral-950 hover:scale-102 hover:shadow-md hover:border-green-300 dark:hover:border-green-700">
                            <span class="mt-1 text-green-500 transition-transform duration-300 shrink-0 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="transition-all duration-300 size-5 hover:rotate-12">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <div class="transition-all duration-300">
                                <h4 class="font-medium transition-colors duration-300 hover:text-green-600 dark:hover:text-green-400">Simple Script Integration</h4>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">Just copy and paste one line
                                    of code.</p>
                            </div>
                        </div>
                        <div
                            class="flex items-start gap-3 p-4 transition-all duration-300 transform bg-white border rounded-lg border-neutral-200 dark:border-neutral-800 dark:bg-neutral-950 hover:scale-102 hover:shadow-md hover:border-green-300 dark:hover:border-green-700">
                            <span class="mt-1 text-green-500 transition-transform duration-300 shrink-0 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="transition-all duration-300 size-5 hover:rotate-12">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <div class="transition-all duration-300">
                                <h4 class="font-medium transition-colors duration-300 hover:text-green-600 dark:hover:text-green-400">Customizable Widget</h4>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">Match the look and feel of your brand.</p>
                            </div>
                        </div>
                        <div
                            class="flex items-start gap-3 p-4 transition-all duration-300 transform bg-white border rounded-lg border-neutral-200 dark:border-neutral-800 dark:bg-neutral-950 hover:scale-102 hover:shadow-md hover:border-green-300 dark:hover:border-green-700">
                            <span class="mt-1 text-green-500 transition-transform duration-300 shrink-0 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="transition-all duration-300 size-5 hover:rotate-12">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <div class="transition-all duration-300">
                                <h4 class="font-medium transition-colors duration-300 hover:text-green-600 dark:hover:text-green-400">Real-time Dashboard</h4>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">See your NPS score and feedback instantly.</p>
                            </div>
                        </div>
                        <div
                            class="flex items-start gap-3 p-4 transition-all duration-300 transform bg-white border rounded-lg border-neutral-200 dark:border-neutral-800 dark:bg-neutral-950 hover:scale-102 hover:shadow-md hover:border-green-300 dark:hover:border-green-700">
                            <span class="mt-1 text-green-500 transition-transform duration-300 shrink-0 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="transition-all duration-300 size-5 hover:rotate-12">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <div class="transition-all duration-300">
                                <h4 class="font-medium transition-colors duration-300 hover:text-green-600 dark:hover:text-green-400">No Setup</h4>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">No databases, no server config needed.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>

            {{-- Pricing Section --}}
            <section class="py-16 bg-white dark:bg-neutral-950 sm:py-24">
                <div class="container px-4 mx-auto text-center sm:px-6 lg:px-8">
                    <h2 class="mb-12 text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl">
                        One-time payment. Unlimited feedback.</h2>
                    <div class="flex flex-col items-stretch justify-center max-w-4xl gap-8 mx-auto lg:flex-row">
                        {{-- Pricing Card 1: Basic --}}
                        <div
                            class="flex flex-col flex-1 w-full p-8 border rounded-lg border-neutral-200 dark:border-neutral-800 lg:w-auto">
                            <h3 class="mb-4 text-2xl font-semibold">Basic Pack</h3>
                            <p class="mb-1 text-4xl font-bold"><span
                                    class="text-neutral-500 dark:text-neutral-400">$</span>9</p>
                            <p class="mb-6 text-sm font-normal text-neutral-500 dark:text-neutral-400">one-time payment
                            </p>
                            <ul class="flex-grow mb-8 space-y-3 text-left text-neutral-600 dark:text-neutral-300">
                                <li class="flex items-center gap-2"><span class="text-green-500"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                            fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                                                clip-rule="evenodd" />
                                        </svg></span> Unlimited responses</li>
                                <li class="flex items-center gap-2"><span class="text-green-500"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                            fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                                                clip-rule="evenodd" />
                                        </svg></span> 1 Tag per site</li>
                                <li class="flex items-center gap-2"><span class="text-green-500"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                            fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                                                clip-rule="evenodd" />
                                        </svg></span> 1 Site </li>

                            </ul>
                            <button type="button"
                                class="mt-auto w-full inline-flex items-center justify-center rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 px-5 py-2.5 text-sm font-medium text-neutral-700 dark:text-neutral-300 shadow-sm hover:bg-neutral-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-950 transition-colors">
                                Get Basic
                            </button>
                        </div>
                        {{-- Pricing Card 2: Pro --}}
                        <div
                            class="relative flex flex-col flex-1 w-full p-8 border-2 border-indigo-600 rounded-lg shadow-lg dark:border-indigo-500 lg:w-auto dark:shadow-indigo-900/20">
                            <span
                                class="absolute px-3 py-1 text-xs font-semibold text-white -translate-x-1/2 bg-indigo-600 rounded-full shadow -top-3 left-1/2">Most
                                Popular</span>
                            <h3 class="mb-4 text-2xl font-semibold">Pro Pack</h3>
                            <p class="mb-1 text-4xl font-bold"><span
                                    class="text-neutral-500 dark:text-neutral-400">$</span>19</p>
                            <p class="mb-6 text-sm font-normal text-neutral-500 dark:text-neutral-400">one-time payment
                            </p>
                            <ul class="flex-grow mb-8 space-y-3 text-left text-neutral-600 dark:text-neutral-300">
                                <li class="flex items-center gap-2"><span class="text-green-500"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                            fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                                                clip-rule="evenodd" />
                                        </svg></span> Unlimited responses</li>
                                <li class="flex items-center gap-2"><span class="text-green-500"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                            fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                                                clip-rule="evenodd" />
                                        </svg></span> 1 Tag per site</li>
                                <li class="flex items-center gap-2"><span class="text-green-500"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                            fill="currentColor" class="size-4">
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
            <section
                class="py-20 bg-gradient-to-b from-neutral-50 to-white dark:from-neutral-900 dark:to-neutral-950 sm:py-28">
                <div class="container px-4 mx-auto text-center sm:px-6 lg:px-8">
                    <h2 class="mb-5 text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl">
                        Ready to get real feedback?</h2>
                    <p class="max-w-xl mx-auto mb-10 text-lg text-neutral-600 dark:text-neutral-400">Drop the snippet,
                        get the scores. It's that easy to start understanding your customers better.</p>
                    <button type="button"
                        class="inline-flex items-center justify-center px-8 py-3 text-lg font-medium text-white transition-colors bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-950">
                        Start Getting Feedback Now
                    </button>
                </div>
            </section>

        </main>

        {{-- Footer --}}
        <footer class="border-t border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900">
            <div class="container px-4 py-8 mx-auto text-center sm:px-6 lg:px-8">
                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                    &copy; {{ date('Y') }} NPSpack. All rights reserved. |
                    <a href="{{ route('privacy') }}"
                        class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">Privacy Policy</a> |
                    <a href="{{ route('terms') }}"
                        class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">Terms of Service</a>
                </p>
                {{-- Optional: Add social links or other footer content here --}}
            </div>
        </footer>

    </div> {{-- End min-h-screen flex flex-col --}}

</body>

</html>
