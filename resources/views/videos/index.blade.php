<x-wireuse::layout-container class="flex flex-col flex-nowrap gap-y-2">
    <livewire:app::videos-filters wire:model.live="form.search" />

    <div
        class="grid gap-y-2 grid-cols-1 divide-y divide-gray-700 overflow-hidden"
        wire:poll.keep-alive.2400s
    >
        @forelse ($this->items as $item)
            <x-app::videos-card :$item />
        @empty
            <div class="flex items-center justify-center p-8 text-gray-400">
                {{ __('No videos found') }}
            </div>
        @endforelse

        <div class="py-4">
            {{ $this->items->links('pagination.simple') }}
        </div>
    </div>
</x-wireuse::layout-container>
