<x-wireuse::layout.container class="flex flex-col gap-y-6 py-6" fluid>
    <div
        class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
        wire:poll.visible.900s
    >
        @forelse ($this->items as $item)
            <x-app.videos.item :$item />
        @empty
            {{ __('No items found') }}
        @endforelse
    </div>
</x-wireuse::layout.container>
