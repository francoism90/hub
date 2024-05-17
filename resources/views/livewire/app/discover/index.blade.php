<div>
    <x-app.discover.videos.search />

    <x-app.layout.container class="flex flex-col py-6 gap-y-6" fluid>
        @if ($form->filled('query', 'tag'))
            <main
                class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                wire:poll.visible.900s
            >
                @forelse ($this->items as $item)
                    <x-app.videos.item :$item />
                @empty
                    {{ __('No videos found') }}
                @endforelse
            </main>

            {{ $this->items->links() }}
        @endif

        @unless ($form->query())
            <livewire:livewire.discover.tags.items />
        @endunless
    </x-app.layout.container>
</div>
