<x-layouts.app title="Mijn Sites">
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
                Mijn Sites
            </h1>
            @if($canCreateMore)
                <a href="{{ route('sites.create') }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    Nieuwe Site
                </a>
            @else
                 <flux:tooltip content="Upgrade naar Pro voor onbeperkte sites (Basic: max 1 site)" position="left">
                    <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-200 border border-transparent rounded-md cursor-not-allowed dark:bg-gray-700 dark:text-gray-500">
                       Nieuwe Site
                    </span>
                </flux:tooltip>
            @endif
        </div>

        <div class="overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Naam</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Domein</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Public ID</th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Aangemaakt op</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Acties</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($sites as $site)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">{{ $site->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">{{ $site->domain }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300"><code>{{ $site->public_id }}</code></td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">{{ $site->created_at->isoFormat('lll') }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    {{-- Script Tag Display (Later) --}}
                                    <button type="button" onclick="showScriptTag('{{ $site->public_id }}')" class="mr-3 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Script</button>
                                    <a href="{{ route('sites.edit', $site) }}" class="mr-3 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Bewerk</a>
                                    <form action="{{ route('sites.destroy', $site) }}" method="POST" class="inline-block" onsubmit="return confirm('Weet je zeker dat je deze site wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Verwijder</button>
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
    <div id="scriptModal" x-data="{ open: false, publicId: '' }" x-show="open" style="display: none;" @keydown.escape.window="open = false" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:p-6">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100" id="modal-title">
                        Embed Script
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Plaats het volgende script in de <code>&lt;head&gt;</code> of <code>&lt;body&gt;</code> van je website om NPS-feedback te verzamelen.
                        </p>
                        <div class="p-3 mt-4 font-mono text-sm text-gray-800 bg-gray-100 rounded-md dark:bg-gray-900 dark:text-gray-200">
                            &lt;script src="{{ config('app.url') }}/js/nps-widget.js" data-site-id="<span x-text=\"publicId\"></span>" defer&gt;&lt;/script&gt;
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <button @click="open = false" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        Sluiten
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showScriptTag(publicId) {
            const modal = document.getElementById('scriptModal');
            const alpineData = modal.__x.
            alpineData.publicId = publicId;
            alpineData.open = true;
        }
    </script>
</x-layouts.app> 