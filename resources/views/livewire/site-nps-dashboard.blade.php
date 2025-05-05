<div class="space-y-8">
    {{-- Site Selector --}}
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">NPS Dashboard for <span class="text-indigo-500">{{ $sites->firstWhere('id', $selectedSiteId)->name }}</span></h2>
        @if($sites->isNotEmpty())
            <div>
                <label for="site_selector" class="sr-only">Selecteer Site</label>
                <select wire:model.live="selectedSiteId" id="site_selector" name="site_selector"
                        class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">-- Selecteer een site --</option>
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->name }} ({{ $site->domain }})</option>
                    @endforeach
                </select>
            </div>
         @else
             <p class="text-sm text-gray-500 dark:text-gray-400">Je hebt nog geen sites aangemaakt.</p>
         @endif
    </div>

    @if($selectedSiteId)
        {{-- Metrics Section --}}
        <section>
            <h3 class="mb-4 text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Overzicht Metrics</h3>
            <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">NPS Score</dt>
                    <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">{{ $npsScore }}</dd>
                </div>
                <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Gemiddelde Score</dt>
                    <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">{{ $averageScore }}</dd>
                </div>
                <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Totaal Responses</dt>
                    <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">{{ $totalResponses }}</dd>
                </div>
            </dl>
            <div class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-3">
                <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
                    <dt class="text-sm font-medium text-green-600 truncate dark:text-green-400">Promoters (9-10)</dt>
                    <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">{{ $promotersCount }} ({{ $promotersPercentage }}%)</dd>
                </div>
                <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
                    <dt class="text-sm font-medium text-yellow-600 truncate dark:text-yellow-400">Passives (7-8)</dt>
                    <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">{{ $passivesCount }} ({{ $passivesPercentage }}%)</dd>
                </div>
                <div class="px-4 py-5 overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
                    <dt class="text-sm font-medium text-red-600 truncate dark:text-red-400">Detractors (0-6)</dt>
                    <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">{{ $detractorsCount }} ({{ $detractorsPercentage }}%)</dd>
                </div>
            </div>
        </section>

        {{-- Feedback Overview Section --}}
        <section>
            <h3 class="mb-4 text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Feedback Overzicht</h3>
            <div class="overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-lg">
                <div class="px-4 py-5 space-y-4 sm:px-6 md:space-y-0 md:flex md:items-center md:justify-between">
                    <input
                        wire:model.live.debounce.300ms="feedbackSearch"
                        type="text"
                        placeholder="Zoek feedback, IP, tag..."
                        class="block w-full border-gray-300 rounded-md shadow-sm md:w-1/3 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    />
                    <div class="flex space-x-2">
                        <select wire:model.live="feedbackTypeFilter" class="border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Alle Types</option>
                            <option value="Promoter">Promoters</option>
                            <option value="Passive">Passives</option>
                            <option value="Detractor">Detractors</option>
                        </select>
                        {{-- Role filter removed as feedback is anonymous --}}
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                {{-- Score Column --}}
                                <th scope="col" wire:click="sortByFeedback('score')" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer select-none dark:text-gray-300">
                                    <div class="flex items-center">
                                        <span>Score</span>
                                        @if ($feedbackSortBy === 'score')
                                            <span class="ml-1">
                                                @if ($feedbackSortDirection === 'asc')
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                                @else
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </th>
                                {{-- Feedback Column (Not sortable) --}}
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Feedback</th>
                                {{-- Date Column --}}
                                <th scope="col" wire:click="sortByFeedback('submitted_at')" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer select-none dark:text-gray-300">
                                     <div class="flex items-center">
                                        <span>Datum</span>
                                         @if ($feedbackSortBy === 'submitted_at')
                                            <span class="ml-1">
                                                @if ($feedbackSortDirection === 'asc')
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                                @else
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </th>
                                {{-- Type Column (Not sortable) --}}
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Type</th>
                                {{-- IP Address Column --}}
                                <th scope="col" wire:click="sortByFeedback('ip_address')" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer select-none dark:text-gray-300">
                                    <div class="flex items-center">
                                        <span>IP Adres</span>
                                         @if ($feedbackSortBy === 'ip_address')
                                            <span class="ml-1">
                                                @if ($feedbackSortDirection === 'asc')
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                                @else
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </th>
                                {{-- Tag Column --}}
                                 <th scope="col" wire:click="sortByFeedback('tag')" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer select-none dark:text-gray-300">
                                     <div class="flex items-center">
                                        <span>Tag</span>
                                         @if ($feedbackSortBy === 'tag')
                                            <span class="ml-1">
                                                @if ($feedbackSortDirection === 'asc')
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                                @else
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                             @if($feedbackResponses && $feedbackResponses->isNotEmpty())
                                @foreach ($feedbackResponses as $response)
                                    <tr wire:key="feedback-{{ $response->id }}">
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($response->score <= 6) bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                @elseif($response->score <= 8) bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 @endif">
                                                {{ $response->score }}
                                            </span>
                                        </td>
                                        <td class="max-w-sm px-6 py-4 text-sm text-gray-500 break-words dark:text-gray-300">{{ $response->feedback ?: '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">{{ $response->submitted_at->isoFormat('lll') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                            @php
            $type = match (true) {
                $response->score >= 9 => 'Promoter',
                $response->score >= 7 => 'Passive',
                default => 'Detractor',
            };
            $typeClass = match ($type) {
                'Promoter' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                'Passive' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                'Detractor' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
            };
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $typeClass }}">
                                                {{ $type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">{{ $response->ip_address ?: '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">{{ $response->tag ?: '-' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                        Geen feedback gevonden voor deze site{{ $feedbackSearch || $feedbackTypeFilter ? ' met de huidige filters' : '' }}.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @if($feedbackResponses)
                <div class="px-4 py-3 border-t border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    {{ $feedbackResponses->links() }}
                </div>
                @endif
            </div>
        </section>
    @elseif($sites->isNotEmpty())
         <div class="p-4 text-center text-gray-500 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-400">
            Selecteer een site hierboven om de resultaten te zien.
        </div>
    @endif

    {{-- User Management section removed as it was from admin context and feedback is anonymous --}}

</div>
