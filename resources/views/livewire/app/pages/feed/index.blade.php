@persist('scrollbar')
<x-wireuse::layout-container
    class="h-[calc(100vh-4rem)] snap-mandatory snap-y overflow-y-scroll bg-black/25"
    fluid
    wire:scroll
>
    <x-app.feed.actions :$actions />

    @forelse ($this->items as $video)
        <livewire:livewire.feed.video :$video :key="$video->getRouteKey()" />
    @empty
        {{ __('No videos available') }}
    @endforelse

    <div x-intersect.full="$wire.fetch()"></div>
</x-wireuse::layout-container>
@endpersist
