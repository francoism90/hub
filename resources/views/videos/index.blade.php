<x-ui-container class="flex flex-nowrap sm:space-x-24">
    <div
        class="grow flex-col divide-y divide-gray-700 overflow-hidden"
        wire:poll.keep-alive.2400s
    >
        @if ($form->filled('search', 'tags'))
            <x-ui-button
                class="btn-ghost m-1.5 p-1.5 text-gray-400"
                wire:click="clear"
            >
                <x-heroicon-o-magnifying-glass-minus class="h-5" />
                <span>{{ __('Reset Filters') }}</span>
            </x-ui-button>
        @endif

        @forelse ($this->items as $item)
            <x-videos-card :$item />
        @empty
            <div class="flex items-center justify-center p-8 text-gray-400">
                {{ __('No videos found') }}
            </div>
        @endforelse

        {{ $this->items->links('pagination.simple') }}
    </div>

    <x-videos-filters />
</x-ui-container>
