<div>
    @persist('scrollbar')
        <div
            class="relative h-viewport overflow-y-scroll snap-y snap-mandatory"
            wire:scroll
        >
            @foreach ($this->items as $item)
                @if ($item->getMorphClass() === 'video')
                    <livewire:livewire.feed.video :video="$item" :$preview :key="$this->hash" />
                @endif
            @endforeach

            <div x-intersect.full="$wire.fetch()"></div>
        </div>
    @endpersist

    <livewire:livewire.app.ui.footer />
</div>
