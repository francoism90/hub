@persist('scrollbar')
<div
    class="h-dvh min-h-dvh snap-y snap-mandatory overflow-y-scroll"
    wire:scroll
>
    @forelse ($this->items as $item)
        @if ($item->getMorphClass() === 'video')
            <livewire:livewire.feed.video :video="$item" :key="$item->getRouteKey()" />
        @endif
    @empty
        {{ __('Please checkout later') }}
    @endforelse

    <div x-intersect.full="$wire.fetch()"></div>
</div>
@endpersist
