<x-layouts.app :title="__('Docs')">
    <div 
        class="flex flex-col flex-1 w-full h-full gap-4 rounded-xl"
        x-data="docsSearch()" 
        x-init="init()"
    >
    <div class="relative w-full mb-6">
        <flux:heading size="xl" level="1">{{ __('Documentation') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Documentation for the application') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
        <div class="container px-4 py-8 mx-auto">
            
            
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1">
                    <div class="sticky p-4 bg-white border rounded-lg shadow-sm top-4 border-zinc-200">
                        <h2 class="mb-4 text-lg font-semibold text-zinc-800">Contents</h2>
                        <nav class="space-y-1">
                            <a href="#getting-started" class="block px-3 py-2 font-medium rounded-md bg-primary-50 text-primary-700">Getting Started</a>
                            <a href="#installation" class="block px-3 py-2 rounded-md hover:bg-zinc-100 text-zinc-700">Installation</a>
                            <a href="#configuration" class="block px-3 py-2 rounded-md hover:bg-zinc-100 text-zinc-700">Configuration</a>
                            <a href="#features" class="block px-3 py-2 rounded-md hover:bg-zinc-100 text-zinc-700">Features</a>
                            <a href="#api" class="block px-3 py-2 rounded-md hover:bg-zinc-100 text-zinc-700">API Reference</a>
                            <a href="#troubleshooting" class="block px-3 py-2 rounded-md hover:bg-zinc-100 text-zinc-700">Troubleshooting</a>
                        </nav>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div class="prose prose-zinc max-w-none">
                        <!-- Getting Started Section -->
                        <section id="getting-started" class="p-6 mb-12 bg-white border rounded-lg shadow-sm border-zinc-200">
                            <h2 class="mb-4 text-2xl font-bold text-zinc-800">Getting Started</h2>
                            <p class="mb-4">Welcome to our application documentation. This guide will help you understand how to set up, configure, and use all the features of our platform.</p>
                            <p>Before you begin, make sure you have the following prerequisites:</p>
                            <ul class="pl-6 mb-4 list-disc">
                                <li>PHP 8.1 or higher</li>
                                <li>Composer installed</li>
                                <li>Node.js and NPM</li>
                                <li>A database server (MySQL, PostgreSQL, etc.)</li>
                            </ul>
                            <div class="p-4 rounded-md bg-zinc-50">
                                <p class="text-sm text-zinc-600">This documentation is continuously updated. If you find any issues or have suggestions for improvement, please let us know.</p>
                            </div>
                        </section>
                        
                        <!-- Installation Section -->
                        <section id="installation" class="p-6 mb-12 bg-white border rounded-lg shadow-sm border-zinc-200">
                            <h2 class="mb-4 text-2xl font-bold text-zinc-800">Installation</h2>
                            <p class="mb-4">Follow these steps to install the application:</p>
                            
                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">1. Clone the repository</h3>
                                <div class="p-3 overflow-x-auto rounded-md bg-zinc-900 text-zinc-200">
                                    <code>git clone https://github.com/yourusername/yourrepository.git</code>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">2. Install dependencies</h3>
                                <div class="p-3 mb-2 overflow-x-auto rounded-md bg-zinc-900 text-zinc-200">
                                    <code>composer install</code>
                                </div>
                                <div class="p-3 overflow-x-auto rounded-md bg-zinc-900 text-zinc-200">
                                    <code>npm install && npm run build</code>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">3. Set up environment</h3>
                                <div class="p-3 mb-2 overflow-x-auto rounded-md bg-zinc-900 text-zinc-200">
                                    <code>cp .env.example .env</code>
                                </div>
                                <p class="mt-2 text-sm text-zinc-600">Edit the .env file to configure your database and other settings.</p>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">4. Generate application key</h3>
                                <div class="p-3 overflow-x-auto rounded-md bg-zinc-900 text-zinc-200">
                                    <code>php artisan key:generate</code>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">5. Run migrations</h3>
                                <div class="p-3 overflow-x-auto rounded-md bg-zinc-900 text-zinc-200">
                                    <code>php artisan migrate</code>
                                </div>
                            </div>
                            
                            <div class="p-4 border-l-4 rounded-md bg-primary-50 border-primary-500">
                                <p class="text-primary-800">For a development environment, you can seed the database with test data using <code class="bg-primary-100 px-1 py-0.5 rounded">php artisan db:seed</code></p>
                            </div>
                        </section>
                        
                        <!-- Configuration Section -->
                        <section id="configuration" class="p-6 mb-12 bg-white border rounded-lg shadow-sm border-zinc-200">
                            <h2 class="mb-4 text-2xl font-bold text-zinc-800">Configuration</h2>
                            <p class="mb-4">After installation, you may want to configure the following aspects of the application:</p>
                            
                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">Environment Settings</h3>
                                <p>The main configuration file is <code class="bg-zinc-100 px-1 py-0.5 rounded">.env</code>. Here are some important settings:</p>
                                <ul class="pl-6 mt-2 list-disc">
                                    <li>Database connection details</li>
                                    <li>Mail server configuration</li>
                                    <li>Queue and cache drivers</li>
                                    <li>Application URL and environment</li>
                                </ul>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="mb-2 text-xl font-semibold text-zinc-700">User Authentication</h3>
                                <p>The application comes with a built-in authentication system. You can customize:</p>
                                <ul class="pl-6 mt-2 list-disc">
                                    <li>Password requirements</li>
                                    <li>Session lifetime</li>
                                    <li>Two-factor authentication settings</li>
                                </ul>
                            </div>
                        </section>
                        
                        <!-- Features Section Placeholder -->
                        <section id="features" class="p-6 mb-12 bg-white border rounded-lg shadow-sm border-zinc-200">
                            <h2 class="mb-4 text-2xl font-bold text-zinc-800">Features</h2>
                            <p class="mb-4">Our application includes the following key features:</p>
                            
                            <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2">
                                <div class="p-4 border rounded-lg border-zinc-200">
                                    <h3 class="mb-2 text-lg font-semibold text-zinc-700">User Management</h3>
                                    <p class="text-zinc-600">Comprehensive user management with roles and permissions.</p>
                                </div>
                                
                                <div class="p-4 border rounded-lg border-zinc-200">
                                    <h3 class="mb-2 text-lg font-semibold text-zinc-700">Dashboard Analytics</h3>
                                    <p class="text-zinc-600">Real-time analytics and reporting dashboard.</p>
                                </div>
                                
                                <div class="p-4 border rounded-lg border-zinc-200">
                                    <h3 class="mb-2 text-lg font-semibold text-zinc-700">Content Management</h3>
                                    <p class="text-zinc-600">Easy-to-use content management system.</p>
                                </div>
                                
                                <div class="p-4 border rounded-lg border-zinc-200">
                                    <h3 class="mb-2 text-lg font-semibold text-zinc-700">API Integration</h3>
                                    <p class="text-zinc-600">RESTful API for third-party integrations.</p>
                                </div>
                            </div>
                            
                            <p class="text-zinc-600">Each feature is documented in detail in its own section.</p>
                        </section>
                        
                        <!-- Suggestions for Documentation Improvement -->
                        <section class="p-6 mb-12 border rounded-lg shadow-sm bg-secondary-50 border-secondary-200">
                            <h2 class="mb-4 text-2xl font-bold text-secondary-700">Documentation Best Practices</h2>
                            <p class="mb-4">Consider enhancing your documentation with the following elements:</p>
                            
                            <ul class="pl-6 mb-4 list-disc text-zinc-700">
                                <li>Video tutorials for complex features</li>
                                <li>Interactive examples where possible</li>
                                <li>Searchable content for quick reference</li>
                                <li>Versioned documentation to match application releases</li>
                                <li>User feedback mechanism to improve documentation</li>
                                <li>Frequently Asked Questions (FAQ) section</li>
                                <li>Changelog to track updates</li>
                            </ul>
                            
                            <div class="p-4 bg-white rounded-md">
                                <p class="text-sm text-zinc-600">Remember that good documentation is living and evolving. Regular updates based on user feedback and new features are essential.</p>
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
                query: '',
                sections: [],
                results: [],
                init() {
                    // Collect content from sections
                    document.querySelectorAll('section[id]').forEach(section => {
                        const titleElement = section.querySelector('h2');
                        if (titleElement) {
                            this.sections.push({
                                id: section.id,
                                title: titleElement.textContent.trim(),
                                // Simple text extraction, might need refinement
                                content: section.innerText.toLowerCase(), 
                                // Get first ~150 chars for preview
                                preview: section.innerText.substring(0, 150).trim() 
                            });
                        }
                    });

                    this.$watch('query', (value) => {
                        this.search();
                    });

                    // Focus input when modal opens
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
                        // Add a temporary highlight effect (optional)
                        element.classList.add('ring-2', 'ring-primary-500', 'ring-offset-2', 'dark:ring-offset-zinc-900', 'transition-all', 'duration-300', 'ease-in-out');
                        setTimeout(() => {
                             element.classList.remove('ring-2', 'ring-primary-500', 'ring-offset-2', 'dark:ring-offset-zinc-900', 'transition-all', 'duration-300', 'ease-in-out');
                        }, 1500);
                    }
                    this.searchOpen = false; // Close modal after navigating
                }
            }
        }
    </script>
</x-layouts.app>