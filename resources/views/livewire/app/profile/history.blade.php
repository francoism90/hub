<x-wireuse::layout.container class="flex flex-col py-6 gap-y-6" fluid>
    <div class="flex items-center py-1">
        <h1 class="font-serif font-bold text-3xl text-secondary leading-none tracking-tight">
            {{ __('History') }}
        </h1>
    </div>

    <main
        class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
        wire:poll.visible.900s
    >
        @forelse ($this->items as $item)
            <x-app.videos.item :$item />
        @empty
            {{ __('No items found') }}
        @endforelse
    </main>

    {{ $this->items->links() }}
</x-wireuse::layout.container>
