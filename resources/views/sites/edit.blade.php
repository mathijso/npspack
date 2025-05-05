<x-layouts.app :title="'Edit Site: ' . $site->name">
    <div class="container px-4 mx-auto mt-8 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

            {{-- Flash Messages --}}
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
                     &larr; Back to Overview
                 </a>
                 <h1 class="mt-2 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                     Edit Site: {{ $site->name }}
                 </h1>
             </div>

            <div class="p-6 bg-white shadow dark:bg-gray-800 sm:rounded-lg">
                <form action="{{ route('sites.update', $site) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $site->name) }}" required
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="domain" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Domain</label>
                        <input type="text" name="domain" id="domain" value="{{ old('domain', $site->domain) }}" required placeholder="example.com"
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('domain') border-red-500 @enderror">
                         @error('domain')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter the main domain (without https://).</p>
                    </div>

                     {{-- Display Public ID (Readonly) --}}
                     <div class="mb-6">
                         <label for="public_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Public ID (for script)</label>
                         <input type="text" id="public_id" value="{{ $site->public_id }}" readonly
                                class="block w-full px-3 py-2 mt-1 text-gray-500 bg-gray-100 border border-gray-300 rounded-md shadow-sm cursor-not-allowed dark:border-gray-600 dark:bg-gray-900 dark:text-gray-400 focus:outline-none sm:text-sm">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">You use this ID in the embed script.</p>
                     </div>

                    {{-- Allowed Paths --}}
                    <div class="mb-6">
                        <label for="allowed_paths_input" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Allowed Paths (optional)</label>
                        <textarea name="allowed_paths_input" id="allowed_paths_input" rows="5"
                               placeholder="/about-us
/blog/*
/contact.html"
                               class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('allowed_paths_input') border-red-500 @enderror">{{ old('allowed_paths_input', $site->allowed_paths ? implode("\n", $site->allowed_paths) : '') }}</textarea>
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
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app> 