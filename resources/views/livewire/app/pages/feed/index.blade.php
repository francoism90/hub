@persist('scrollbar')
<x-wireuse::layout-container
    class="relative h-[calc(100vh-4rem)] w-screen snap-mandatory snap-y overflow-y-scroll bg-black/25"
    fluid
    wire:scroll
>
    @forelse ($this->items as $item)
        <article class="relative w-full h-full snap-center">
            @if ($item->getMorphClass() === 'video')
                <livewire:livewire.feed.video :video="$item" :key="$item->getRouteKey()" />
            @endif
        </article>
    @empty
        {{ __('Please come back later!') }}
    @endforelse

    <div x-intersect.full="$wire.fetch()"></div>
</x-wireuse::layout-container>
@endpersist
