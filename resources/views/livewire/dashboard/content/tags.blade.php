<x-app.layout.container class="flex flex-col py-6 gap-y-6" fluid>
    <x-dashboard.videos.filters :$actions />

    <main
        class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
        wire:poll.visible.900s
    >
        @forelse ($this->items as $item)
            <x-dashboard.tags.item :$item />
        @empty
            {{ __('No items found') }}
        @endforelse
    </main>

    {{ $this->items->links() }}
</x-app.layout.container>
