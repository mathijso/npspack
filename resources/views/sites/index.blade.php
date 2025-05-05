<x-layouts.app :title="__('My Sites')">

{{-- Add CSS for x-cloak --}}
@push('styles')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

    <div class="container px-4 mx-auto mt-8 sm:px-6 lg:px-8">

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

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                My Sites
            </h1>
            @if($canCreateMore)
                <a href="{{ route('sites.create') }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add New Site
                </a>
            @else
                 <flux:tooltip content="Upgrade to Pro for unlimited sites (Basic: max 1 site)" position="left">
                    <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-200 border border-transparent rounded-md cursor-not-allowed dark:bg-gray-700 dark:text-gray-500">
                       Add New Site
                    </span>
                </flux:tooltip>
            @endif
        </div>

        <div class="overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Name</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Domain</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Number of responses</th>

                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Public ID</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Created at</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($sites as $site)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">{{ $site->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                    <a href="https://{{ $site->domain }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">{{ $site->domain }}</a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">{{ $site->responses->count() }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300"><code>{{ $site->public_id }}</code></td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">{{ $site->created_at->isoFormat('lll') }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    {{-- Script Tag Display (Later) --}}
                                    <button type="button" onclick="showSiteScriptModal('{{ $site->public_id }}')" class="mr-3 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Script</button>
                                        <a href="{{ route('sites.edit', $site) }}" class="mr-3 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                                        <form action="{{ route('sites.destroy', $site) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this site?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                    Je hebt nog geen sites aangemaakt.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Simple Modal for Script Tag --}}
    {{-- Initialize Alpine by calling scriptModalData() --}}
    {{-- Listen for the custom 'open-script-modal' event on the window --}}
    <div id="scriptModal" x-data="scriptModalData()"
         @open-script-modal.window="
            publicId = $event.detail.publicId;
            buttonText = 'Kopieer Script'; // Reset button text
            open = true;
         "
         x-show="open" x-cloak
         style="display: none;"
         @keydown.escape.window="open = false"
         class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    >
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            {{-- Background overlay --}}
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900/80" @click="open = false" aria-hidden="true"></div>

            {{-- Modal panel --}}
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:p-6">
                <div>
                    <div class="flex items-center justify-between">
                         <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100" id="modal-title">
                            Embed Script voor <span x-text="siteNameToCopy"></span>
                        </h3>
                        <button @click="open = false" type="button" class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                            <span class="sr-only">Sluiten</span>
                             <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-3">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Kopieer en plak dit script vlak voor de afsluitende <code>&lt;/body&gt;</code> tag op je website.
                        </p>
                        <div class="relative mt-4">
                            <textarea x-ref="scriptToCopy" readonly
                                      class="block w-full px-3 py-2 text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded-md shadow-sm resize-none dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" rows="4"></textarea>
                             <button @click="copyToClipboard($refs.scriptToCopy.value)"
                                     class="absolute p-1 text-gray-400 bg-gray-200 rounded top-2 right-2 hover:text-gray-600 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-gray-300">
                                <span x-show="!copied">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </span>
                                 <span x-show="copied" style="display: none;">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                 </span>
                            </button>
                        </div>
                        <p x-show="copied" class="mt-1 text-xs text-green-600 dark:text-green-400" style="display: none;">Gekopieerd!</p>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <button @click="open = false" type="button" class="inline-flex justify-center w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                        Sluiten
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Define the data structure for the Alpine component
        function scriptModalData() {
            return {
                open: false,
                publicId: '',
                buttonText: 'Kopieer Script',
                appUrl: '{{ rtrim(config("app.url"), '/') }}',
                get scriptContent() {
                    // Use string concatenation for robustness
                    return '<script src="' + this.appUrl + '/js/nps-widget.js" data-site-id="' + this.publicId + '" defer><\/script>';
                },
                copyToClipboard() {
                    navigator.clipboard.writeText(this.scriptContent).then(() => {
                        this.buttonText = 'Gekopieerd!';
                        setTimeout(() => { this.buttonText = 'Kopieer Script'; }, 2000);
                    }).catch(err => {
                        console.error('Failed to copy: ', err);
                        alert('Kon niet naar klembord kopiëren.');
                    });
                }
                // No need for init() or specific event listeners here anymore for opening
            };
        }

        // Function called by the button's onclick
        function showSiteScriptModal(publicId) {
            // Dispatch a custom browser event that Alpine can listen for
             window.dispatchEvent(new CustomEvent('open-script-modal', {
                 detail: { publicId: publicId }
             }));
        }
    </script>
</x-layouts.app> 