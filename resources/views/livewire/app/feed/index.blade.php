<div>
    @persist('scrollbar')
        <div
            class="relative h-viewport overflow-y-scroll snap-y snap-mandatory"
            wire:scroll
        >
            @forelse ($this->items as $item)
                @if ($item->getMorphClass() === 'video')
                    <livewire:livewire.feed.video :video="$item" :key="$this->hash" />
                @endif
            @empty
                {{ __('No items found') }}
            @endforelse

            <div x-intersect.full="$wire.fetch()"></div>
        </div>
    @endpersist

    <livewire:livewire.app.ui.footer />
</div>
