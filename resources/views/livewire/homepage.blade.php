<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

// You might want to uncomment these if you decide to use them later
// name('homepage');
// middleware(['auth']); // Example middleware

new class extends Component {
    // Properties or methods can be added here if needed
}; ?>

<div class="font-sans antialiased text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-gray-100 min-h-screen">

    {{-- Hero Section --}}
    <section class="container mx-auto px-6 py-20 text-center">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">Drop a script. Get real feedback. 🎯</h1>
        <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 mb-8">
            Start collecting Net Promoter Scores in under a minute. No integrations, no bloat.
        </p>
        <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-4 mb-12">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out">
                Copy snippet
            </button>
            <button class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out">
                View dashboard (soon)
            </button>
        </div>
        <div class="flex justify-center">
            <pre class="bg-gray-100 dark:bg-gray-800 text-left p-4 rounded-lg shadow-inner overflow-x-auto"><code class="text-sm text-gray-700 dark:text-gray-300">&lt;script src="https://cdn.npspack.com/widget.js" data-id="abc123"&gt;&lt;/script&gt;</code></pre>
        </div>
    </section>

    {{-- "Why NPS?" Section --}}
    <section class="bg-white dark:bg-gray-800 py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-10">Why NPS? It's simple.</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="flex flex-col items-center">
                    <div class="text-5xl mb-4">📊</div>
                    <h3 class="text-xl font-semibold mb-2">Gauge Loyalty</h3>
                    <p class="text-gray-600 dark:text-gray-400">Understand customer satisfaction and predict growth.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="text-5xl mb-4">💡</div>
                    <h3 class="text-xl font-semibold mb-2">Identify Issues</h3>
                    <p class="text-gray-600 dark:text-gray-400">Quickly spot unhappy customers and address their concerns.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="text-5xl mb-4">📈</div>
                    <h3 class="text-xl font-semibold mb-2">Drive Improvement</h3>
                    <p class="text-gray-600 dark:text-gray-400">Use feedback to make your product better, step by step.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="container mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold text-center mb-10">Packed with essentials. No fluff.</h2>
        <div class="max-w-2xl mx-auto text-left space-y-4 text-gray-700 dark:text-gray-300">
             <p class="flex items-center"><span class="text-green-500 mr-2">✅</span> Simple script integration (copy & paste)</p>
             <p class="flex items-center"><span class="text-green-500 mr-2">✅</span> Customizable widget appearance</p>
             <p class="flex items-center"><span class="text-green-500 mr-2">✅</span> Real-time feedback dashboard</p>
             <p class="flex items-center"><span class="text-green-500 mr-2">✅</span> No complex setup needed</p>
             <p class="flex items-center"><span class="text-green-500 mr-2">✅</span> Developer-friendly</p>
             <p class="flex items-center"><span class="text-green-500 mr-2">😬</span> Still missing that one feature? Tell us!</p>
        </div>
    </section>

    {{-- Pricing Section --}}
    <section class="bg-white dark:bg-gray-800 py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-10">One-time payment. Unlimited feedback.</h2>
            <div class="flex flex-col md:flex-row justify-center items-stretch gap-8 max-w-4xl mx-auto">
                {{-- Pricing Card 1 --}}
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-8 flex flex-col flex-1">
                    <h3 class="text-2xl font-semibold mb-4">Basic Pack</h3>
                    <p class="text-4xl font-bold mb-6">$49 <span class="text-lg font-normal text-gray-500 dark:text-gray-400">/ one-time</span></p>
                    <ul class="text-left space-y-2 mb-8 text-gray-600 dark:text-gray-300 flex-grow">
                        <li><span class="text-green-500 mr-2">✓</span> Up to 10,000 views/month</li>
                        <li><span class="text-green-500 mr-2">✓</span> Basic dashboard</li>
                        <li><span class="text-green-500 mr-2">✓</span> Email support</li>
                    </ul>
                    <button class="mt-auto w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out">Get Basic</button>
                </div>
                {{-- Pricing Card 2 --}}
                <div class="border-2 border-indigo-600 rounded-lg p-8 flex flex-col relative flex-1">
                     <span class="absolute top-0 right-0 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">Most Popular</span>
                    <h3 class="text-2xl font-semibold mb-4">Pro Pack</h3>
                    <p class="text-4xl font-bold mb-6">$99 <span class="text-lg font-normal text-gray-500 dark:text-gray-400">/ one-time</span></p>
                    <ul class="text-left space-y-2 mb-8 text-gray-600 dark:text-gray-300 flex-grow">
                        <li><span class="text-green-500 mr-2">✓</span> Unlimited views</li>
                        <li><span class="text-green-500 mr-2">✓</span> Advanced dashboard</li>
                        <li><span class="text-green-500 mr-2">✓</span> Widget customization</li>
                        <li><span class="text-green-500 mr-2">✓</span> Priority support</li>
                    </ul>
                    <button class="mt-auto w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out">Get Pro</button>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="container mx-auto px-6 py-20 text-center">
         <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to get real feedback?</h2>
         <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Drop the snippet, get the scores. It's that easy.</p>
         <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-lg shadow-lg text-lg transition duration-300 ease-in-out">
             Get feedback now
         </button>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-100 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
        <div class="container mx-auto px-6 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} NPSPack. All rights reserved. |
            <a href="https://github.com/your-repo" target="_blank" rel="noopener noreferrer" class="hover:text-indigo-600 dark:hover:text-indigo-400">GitHub</a> |
            <a href="https://twitter.com/your-handle" target="_blank" rel="noopener noreferrer" class="hover:text-indigo-600 dark:hover:text-indigo-400">Twitter</a>
        </div>
    </footer>

</div> 