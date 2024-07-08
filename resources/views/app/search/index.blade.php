<div class="flex flex-col p-3">
    {{-- <x-wireuse::layout.container class="flex flex-col gap-y-6" fluid>
        <x-app.search.filters />

        @if ($form->query()->isNotEmpty())
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
        @else
            <livewire:livewire.search.tags.items />
        @endif
    </x-wireuse::layout.container> --}}
</div>
