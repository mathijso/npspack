<x-layouts.app.header :title="$title ?? null">
    <flux:main class="mt-12">
        {{ $slot }}
    </flux:main>
</x-layouts.app.header>
