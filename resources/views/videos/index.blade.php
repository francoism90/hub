<x-ui-container class="flex flex-nowrap sm:space-x-24">
    <div
        class="flex-col grow overflow-hidden divide-y divide-gray-700"
        wire:poll.keep-alive.10s
    >
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
