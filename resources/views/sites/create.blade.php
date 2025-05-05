<x-layouts.app :title="__('Add New Site')">
    <div class="container px-4 mx-auto mt-8 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

            {{-- Flash Messages (Should not occur often here, but good practice) --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-6">
                 <a href="{{ route('sites.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                     &larr; Back to Site Overview
                 </a>
                 <h1 class="mt-2 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                     Add New Site
                 </h1>
             </div>

            <div class="p-6 bg-white shadow dark:bg-gray-800 sm:rounded-lg">
                <form action="{{ route('sites.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="domain" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Domain</label>
                        <input type="text" name="domain" id="domain" value="{{ old('domain') }}" required placeholder="example.com"
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('domain') border-red-500 @enderror">
                         @error('domain')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter the main domain (without https://).</p>
                    </div>

                    {{-- Allowed Paths --}}
                    <div class="mb-6">
                        <label for="allowed_paths_input" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Allowed Paths (optional)</label>
                        <textarea name="allowed_paths_input" id="allowed_paths_input" rows="5"
                               placeholder="/about-us
/blog/*
/contact.html"
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('allowed_paths_input') border-red-500 @enderror">{{ old('allowed_paths_input') }}</textarea>
                        @error('allowed_paths_input')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter one path per line. Paths must start with a /. Use * as a wildcard (e.g., /blog/*). Leave empty to allow the widget on all pages.</p>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('sites.index') }}" class="px-4 py-2 mr-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Cancel
                        </a>
                        <button type="submit"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            Add Site
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app> 