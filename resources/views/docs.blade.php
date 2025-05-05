<x-layouts.app :title="__('Docs')">
    <div 
        class="flex flex-col flex-1 w-full h-full gap-4 rounded-xl"
        x-data="docsSearch()" 
        x-init="init()"
    >
    <div class="relative w-full mb-6">
        <flux:heading size="xl" level="1">{{ __('Documentation') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('How to use the NPS Dashboard application') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
        <div class="container px-4 py-8 mx-auto">
            
            
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1">
                    <div class="sticky p-4 bg-white border rounded-lg shadow-sm top-4 border-zinc-200 dark:bg-gray-800 dark:border-gray-600">
                        <h2 class="mb-4 text-lg font-semibold text-zinc-800 dark:text-white">Contents</h2>
                        <nav class="space-y-1">
                            <a href="#getting-started" class="block px-3 py-2 font-medium rounded-md bg-primary-50 text-primary-700 dark:bg-primary-700 dark:text-white">Getting Started</a>
                            <a href="#features" class="block px-3 py-2 rounded-md hover:bg-zinc-100 text-zinc-700 dark:hover:bg-gray-700 dark:text-gray-300">Features Overview</a>
                            <a href="#nps-dashboard" class="block px-3 py-2 rounded-md hover:bg-zinc-100 text-zinc-700 dark:hover:bg-gray-700 dark:text-gray-300">NPS Dashboard Guide</a>
                            <a href="#adding-sites-script" class="block px-3 py-2 rounded-md hover:bg-zinc-100 text-zinc-700 dark:hover:bg-gray-700 dark:text-gray-300">Adding Sites & Script</a>
                        </nav>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div class="prose prose-zinc max-w-none dark:prose-invert prose-headings:text-zinc-800 dark:prose-headings:text-white prose-p:text-zinc-600 dark:prose-p:text-gray-300 prose-ul:text-zinc-600 dark:prose-ul:text-gray-300 prose-strong:text-zinc-700 dark:prose-strong:text-gray-200 prose-code:bg-zinc-100 dark:prose-code:bg-gray-700 prose-code:text-zinc-700 dark:prose-code:text-gray-200 prose-code:px-1 prose-code:py-0.5 prose-code:rounded">
                        <!-- Getting Started Section -->
                        <section id="getting-started" class="p-6 mb-12 bg-white border rounded-lg shadow-sm border-zinc-200 dark:bg-gray-800 dark:border-gray-700">
                            <h2 class="mb-4 text-2xl font-bold">Getting Started</h2>
                            <p class="mb-4">Welcome! This guide will help you understand how to use the NPS Dashboard application to track customer feedback for your websites.</p>
                            <p class="mb-4">To begin, simply log in to your account. If you haven't created any sites yet, you'll be prompted to do so. The main navigation menu (usually on the left or top) will help you access different parts of the application, such as the dashboard, site settings, and your account profile.</p>
                            <div class="p-4 rounded-md bg-zinc-50 dark:bg-gray-700">
                                <p class="text-sm text-zinc-600 dark:text-gray-300">Need help? If you encounter any issues or have questions, please contact support.</p>
                            </div>
                        </section>
                        
                        <!-- Features Section (User-Focused) -->
                        <section id="features" class="p-6 mb-12 bg-white border rounded-lg shadow-sm border-zinc-200 dark:bg-gray-800 dark:border-gray-700">
                            <h2 class="mb-4 text-2xl font-bold">Features Overview</h2>
                            <p class="mb-4">Our application includes the following key features to help you manage customer feedback:</p>
                            
                            <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2">
                                <div class="p-4 border rounded-lg border-zinc-200 dark:border-gray-700">
                                    <h3 class="mb-2 text-lg font-semibold">Site Management</h3>
                                    <p>Add and manage multiple websites for which you want to collect NPS feedback.</p>
                                </div>
                                
                                <div class="p-4 border rounded-lg border-zinc-200 dark:border-gray-700">
                                    <h3 class="mb-2 text-lg font-semibold">NPS Dashboard</h3>
                                    <p>View detailed NPS scores, trends, and individual feedback comments for each site.</p>
                                </div>
                                
                                <div class="p-4 border rounded-lg border-zinc-200 dark:border-gray-700">
                                    <h3 class="mb-2 text-lg font-semibold">Feedback Filtering & Sorting</h3>
                                    <p>Easily filter feedback by score type (Promoter, Passive, Detractor), date range, or search terms. Sort feedback by score, date, and more.</p>
                                </div>
                                
                                <div class="p-4 border rounded-lg border-zinc-200 dark:border-gray-700">
                                    <h3 class="mb-2 text-lg font-semibold">User Account Management</h3>
                                    <p>Manage your profile settings and account preferences.</p>
                                </div>
                            </div>
                            
                            <p>Explore the <a href="#nps-dashboard" class="text-primary-600 dark:text-primary-400 hover:underline">NPS Dashboard Guide</a> for a detailed walkthrough.</p>
                        </section>

                        <!-- NPS Dashboard Section (Keep as is, maybe adjust title slightly) -->
                        <section id="nps-dashboard" class="p-6 mb-12 bg-white border rounded-lg shadow-sm border-zinc-200 dark:bg-gray-800 dark:border-gray-700">
                            <h2 class="mb-4 text-2xl font-bold">NPS Dashboard Guide</h2>
                            <p class="mb-4">The Net Promoter Score (NPS) Dashboard provides a comprehensive overview of customer feedback for your selected sites.</p>

                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">Site Selection</h3>
                                <p>If you manage multiple sites, use the dropdown menu at the top right of the dashboard to select the specific site for which you want to view NPS data. The dashboard metrics and feedback table will update automatically when you switch sites.</p>
                            </div>

                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">Key Metrics</h3>
                                <p>The dashboard displays several key performance indicators (KPIs) based on the selected site and date filter:</p>
                                <ul class="pl-6 mt-2 list-disc">
                                    <li><strong>NPS Score:</strong> The overall Net Promoter Score, calculated as (% Promoters - % Detractors).</li>
                                    <li><strong>Average Score:</strong> The mathematical average of all submitted scores.</li>
                                    <li><strong>Total Responses:</strong> The total number of feedback responses received.</li>
                                    <li><strong>Promoters (9-10):</strong> Count and percentage of respondents likely to recommend.</li>
                                    <li><strong>Passives (7-8):</strong> Count and percentage of satisfied but unenthusiastic respondents.</li>
                                    <li><strong>Detractors (0-6):</strong> Count and percentage of unhappy respondents unlikely to recommend.</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">Feedback Overview Table</h3>
                                <p>Below the metrics, you'll find a table listing individual feedback responses. This table includes:</p>
                                <ul class="pl-6 mt-2 list-disc">
                                    <li><strong>Score:</strong> The numerical score given by the respondent.</li>
                                    <li><strong>Feedback:</strong> The textual comment left by the respondent (if any).</li>
                                    <li><strong>Date:</strong> When the feedback was submitted.</li>
                                    <li><strong>Type:</strong> Classification as Promoter, Passive, or Detractor based on the score.</li>
                                    <li><strong>IP Address:</strong> The IP address from which the feedback was submitted.</li>
                                    <li><strong>Tag:</strong> Any custom tag associated with the response.</li>
                                </ul>
                            </div>

                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">Filtering and Sorting</h3>
                                <p>You can refine the data shown in the metrics and feedback table using the filters located above the table:</p>
                                <ul class="pl-6 mt-2 list-disc">
                                    <li><strong>Search:</strong> Filter feedback by keywords found in the comment, IP address, or tag.</li>
                                    <li><strong>Type Filter:</strong> Show only Promoters, Passives, or Detractors.</li>
                                    <li><strong>Date Filter:</strong> Limit the data to a specific period (Today, Last 7 Days, Last 30 Days, Last Year, All Time).</li>
                                </ul>
                                <p class="mt-2">You can also sort the feedback table by clicking on the column headers for Score, Date, IP Address, or Tag. Clicking a header again reverses the sort direction.</p>
                            </div>
                        </section>

                        <!-- Adding Sites & Implementing Script Section -->
                        <section id="adding-sites-script" class="p-6 mb-12 bg-white border rounded-lg shadow-sm border-zinc-200 dark:bg-gray-800 dark:border-gray-700">
                            <h2 class="mb-4 text-2xl font-bold">Adding Sites & Implementing the Script</h2>
                            <p class="mb-4">To start collecting NPS feedback, you first need to add your website(s) to the application and then place a unique script tag on your site.</p>

                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold">1. Adding a New Site</h3>
                                <p>Navigate to the "Sites" or "Settings" section within the application (check the main navigation menu). Here you should find an option like "Add New Site" or similar.</p>
                                <p class="mt-2">You will typically need to provide:</p>
                                <ul class="pl-6 mt-2 list-disc">
                                    <li><strong>Site Name:</strong> A descriptive name for your site (e.g., "My Company Blog").</li>
                                    <li><strong>Site Domain:</strong> The exact domain where the script will run (e.g., <code>www.example.com</code> or <code>blog.example.com</code>). Make sure this matches your website's URL precisely, including whether it uses <code>www</code> or not.</li>
                                </ul>
                                <p class="mt-2">After saving the site, it will appear in your list of sites, and you'll be able to generate its unique script tag.</p>
                            </div>

                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold">2. Finding Your Script Tag</h3>
                                <p>Once a site is added, go to its settings or details page within the application. You should find a section displaying the Javascript snippet (script tag) specific to that site.</p>
                                <p class="mt-2">The script tag will look something like this (your actual script URL will be different):</p>
                                <div class="p-3 my-2 overflow-x-auto rounded-md bg-zinc-900 text-zinc-200">
                                    <code>&lt;script src="https://your-nps-app-domain.com/script/YOUR_UNIQUE_SITE_ID.js" defer&gt;&lt;/script&gt;</code>
                                </div>
                                <p class="mt-2">Copy this entire snippet. You need to add this to the HTML of the website you just registered.</p>
                            </div>

                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold">3. Implementing the Script Tag</h3>
                                <p>The script tag should be placed just before the closing <code>&lt;/body&gt;</code> tag in your website's HTML template. This ensures it loads efficiently without blocking page content.</p>
                                <p class="mt-2">Here's how to do it on various platforms:</p>

                                <div class="p-4 mt-4 border-l-4 rounded-md bg-primary-50 border-primary-500 dark:bg-primary-900 dark:border-primary-700">
                                    <h4 class="mb-2 font-semibold text-primary-800 dark:text-primary-200">WordPress</h4>
                                    <p class="text-primary-700 dark:text-primary-300">The easiest way is often using a plugin designed for adding header/footer scripts (e.g., "Insert Headers and Footers"). Paste the script tag into the "Footer" section of the plugin settings.</p>
                                    <p class="mt-1 text-primary-700 dark:text-primary-300">Alternatively, if you're comfortable editing theme files (use a child theme!), you can add the script tag directly into your theme's <code>footer.php</code> file, right before <code>&lt;/body&gt;</code>.</p>
                                    <p class="mt-1 text-primary-700 dark:text-primary-300">Some page builders or themes might also offer a specific setting for adding custom scripts globally.</p>
                                </div>

                                <div class="p-4 mt-4 border-l-4 rounded-md bg-secondary-50 border-secondary-500 dark:bg-secondary-900 dark:border-secondary-700">
                                    <h4 class="mb-2 font-semibold text-secondary-800 dark:text-secondary-200">Other CMS (e.g., Joomla, Drupal, Shopify)</h4>
                                    <p class="text-secondary-700 dark:text-secondary-300">Look for theme settings, template options, or a specific section for "Custom Code" or "Tracking Scripts". Most CMS platforms provide a way to insert code snippets into the header or footer globally across the site. The goal is always to place the script just before the closing <code>&lt;/body&gt;</code> tag in the main template file.</p>
                                    <p class="mt-1 text-secondary-700 dark:text-secondary-300">Consult your specific CMS documentation if you're unsure where to add custom footer scripts.</p>
                                </div>

                                <div class="p-4 mt-4 border-l-4 rounded-md bg-zinc-100 border-zinc-500 dark:bg-gray-700 dark:border-gray-500">
                                    <h4 class="mb-2 font-semibold text-zinc-800 dark:text-gray-200">Laravel</h4>
                                    <p class="text-zinc-700 dark:text-gray-300">In your main Blade layout file (e.g., <code>resources/views/layouts/app.blade.php</code>), find the closing <code>&lt;/body&gt;</code> tag and paste the script tag right before it:</p>
                                    <div class="p-3 my-2 overflow-x-auto rounded-md bg-zinc-900 text-zinc-200">
<pre><code>    ...
    &lt;script src="https://your-nps-app-domain.com/script/YOUR_UNIQUE_SITE_ID.js" defer&gt;&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
                                    </div>
                                </div>

                                <div class="p-4 mt-4 border-l-4 border-teal-500 rounded-md bg-teal-50 dark:bg-teal-900 dark:border-teal-700">
                                    <h4 class="mb-2 font-semibold text-teal-800 dark:text-teal-200">Front-End Frameworks (React, Vue, Angular, Svelte etc.)</h4>
                                    <p class="text-teal-700 dark:text-teal-300">For Single Page Applications (SPAs), you typically add the script tag to the main HTML file that serves as the entry point for your application.</p>
                                    <ul class="pl-6 mt-1 text-teal-700 list-disc dark:text-teal-300">
                                        <li><strong>React (Create React App):</strong> Edit <code>public/index.html</code> and add the script before <code>&lt;/body&gt;</code>.</li>
                                        <li><strong>Vue (Vue CLI / Vite):</strong> Edit <code>public/index.html</code> (Vue CLI) or <code>index.html</code> in the root (Vite) and add the script before <code>&lt;/body&gt;</code>.</li>
                                        <li><strong>Angular (Angular CLI):</strong> Edit <code>src/index.html</code> and add the script before <code>&lt;/body&gt;</code>.</li>
                                        <li><strong>SvelteKit:</strong> Edit <code>src/app.html</code> and add the script before <code>%sveltekit.body%</code> or just before <code>&lt;/body&gt;</code>.</li>
                                    </ul>
                                    <p class="mt-1 text-teal-700 dark:text-teal-300">Avoid adding the script dynamically within component lifecycles unless absolutely necessary, as it should ideally load once with the initial HTML.</p>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold">4. Verification</h3>
                                <p>After adding the script tag, clear any caches on your website (server-side cache, CDN, browser cache) and visit your site. The NPS survey widget should appear according to its configured rules (this might depend on settings within the NPS application not covered here, like display frequency or targeting).</p>
                                <p class="mt-2">You can also check your browser's developer tools (Network tab) to confirm that the script (e.g., <code>YOUR_UNIQUE_SITE_ID.js</code>) is being loaded successfully.</p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Modal -->
        <div 
            x-show="searchOpen" 
            x-cloak
            @keydown.escape.window="searchOpen = false"
            class="fixed inset-0 z-50 flex items-start justify-center pt-16 bg-black/50 backdrop-blur-sm"
        >
            <div 
                x-show="searchOpen" 
                x-trap.inert.noscroll="searchOpen"
                @click.away="searchOpen = false"
                class="relative w-full max-w-xl p-6 mx-4 overflow-hidden bg-white rounded-lg shadow-xl"
            >
                <button @click="searchOpen = false" class="absolute text-zinc-500 hover:text-zinc-700 top-3 right-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>                  
                </button>
                <h2 class="mb-4 text-xl font-semibold text-zinc-800">Search Documentation</h2>
                <div class="relative mb-4">
                    <input 
                        type="search" 
                        x-ref="searchInput"
                        x-model.debounce.300ms="query"
                        placeholder="Search documentation..." 
                        class="w-full px-4 py-2 border rounded-md border-zinc-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>                          
                    </div>
                </div>
                <div class="max-h-[60vh] overflow-y-auto pr-2 -mr-2 space-y-2">
                    <template x-if="query && results.length === 0">
                        <p class="text-center text-zinc-500">No results found.</p>
                    </template>
                    <template x-for="result in results" :key="result . id">
                        <button 
                            @click="goToSection(result.id)" 
                            class="block w-full p-3 text-left rounded-md hover:bg-zinc-100"
                        >
                            <h3 class="font-semibold text-primary-600" x-text="result.title"></h3>
                            <p class="mt-1 text-sm text-zinc-600" x-html="result.preview + '...'"></p>
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <script>
        function docsSearch() {
            return {
                searchOpen: false,
                query: '',
                sections: [],
                results: [],
                init() {
                    const allowedSectionIds = ['getting-started', 'features', 'nps-dashboard', 'adding-sites-script'];
                    document.querySelectorAll('section[id]').forEach(section => {
                        if (allowedSectionIds.includes(section.id)) {
                            const titleElement = section.querySelector('h2');
                            if (titleElement) {
                                this.sections.push({
                                    id: section.id,
                                    title: titleElement.textContent.trim(),
                                    content: section.innerText.toLowerCase(), 
                                    preview: section.innerText.substring(0, 150).trim() 
                                });
                            }
                        }
                    });

                    this.$watch('query', (value) => {
                        this.search();
                    });

                    this.$watch('searchOpen', (isOpen) => {
                        if (isOpen) {
                            this.$nextTick(() => this.$refs.searchInput.focus());
                        }
                    });
                },
                search() {
                    if (!this.query.trim()) {
                        this.results = [];
                        return;
                    }
                    
                    const searchTerm = this.query.toLowerCase();
                    this.results = this.sections.filter(section => {
                        return section.title.toLowerCase().includes(searchTerm) || section.content.includes(searchTerm);
                    });
                },
                goToSection(id) {
                    const element = document.getElementById(id);
                    if (element) {
                        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        element.classList.add('ring-2', 'ring-primary-500', 'ring-offset-2', 'dark:ring-offset-zinc-900', 'transition-all', 'duration-300', 'ease-in-out');
                        setTimeout(() => {
                             element.classList.remove('ring-2', 'ring-primary-500', 'ring-offset-2', 'dark:ring-offset-zinc-900', 'transition-all', 'duration-300', 'ease-in-out');
                        }, 1500);
                    }
                    this.searchOpen = false;
                }
            }
        }
    </script>
</x-layouts.app>