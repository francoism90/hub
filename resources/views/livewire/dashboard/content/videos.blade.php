<x-wireuse::layout-container class="flex flex-col gap-y-3 p-3" fluid>
    <x-dashboard.videos.filters>
        @foreach($filters->all() as $action)
            <x-dynamic-component :component="$action->getComponent()" :$action />
        @endforeach
    </x-dashboard.videos.filters>

    <main
        wire:poll.visible.900s
        class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-3"
    >
        @forelse ($this->items as $item)
            <x-dashboard.videos.content.item :$item />
        @empty

        @endforelse
    </main>
</x-wireuse::layout-container>
