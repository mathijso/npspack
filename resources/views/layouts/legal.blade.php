<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Added CSRF token for potential forms --}}

        <title>@yield('title', config('app.name', 'Laravel'))</title>

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

            {{-- Reusing Header from welcome.blade.php --}}
            <header class="w-full border-b border-neutral-200 dark:border-neutral-800 sticky top-0 bg-white/80 dark:bg-neutral-950/80 backdrop-blur-sm z-20">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex h-16 items-center justify-between">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('home') }}" class="text-lg font-semibold">NPSpack</a>
                    </div>

                    @if (Route::has('login'))
                        <nav class="-my-2 flex items-center justify-end gap-2">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors"
                                >
                                    Go to my Dashboard
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

            <main class="flex-grow py-12 sm:py-16">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="prose dark:prose-invert max-w-4xl mx-auto">
                        {{-- Content from specific legal pages will go here --}}
                        @yield('content')
                    </div>
                </div>
            </main>

            {{-- Reusing Footer from welcome.blade.php --}}
            <footer class="border-t border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900 mt-auto">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center">
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                        &copy; {{ date('Y') }} NPSpack. All rights reserved. |
                        <a href="{{ route('privacy') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Privacy Policy</a> |
                        <a href="{{ route('terms') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Terms of Service</a>
                    </p>
                </div>
            </footer>

        </div>
    </body>
</html> 