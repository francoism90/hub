<div>
    <x-app.search.filters />

    <x-app.layout.container class="flex flex-col py-6" fluid>
        @if ($form->query())
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
        @endif

        @unless ($form->query())
            <livewire:livewire.discover.tags.items />
        @endunless
    </x-app.layout.container>
</div>
