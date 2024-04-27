@persist('scrollbar')
<x-wireuse::layout-container
    class="h-[calc(100vh-4rem)] snap-mandatory snap-y overflow-y-scroll bg-black/25"
    fluid
    wire:scroll
>
    <span class="text-white">Preview: {{ $preview }}</span>

    @forelse ($this->items as $video)
        <livewire:livewire.app.videos.feed.item :$video :key="$video->getRouteKey()" />
    @empty
        {{ __('No videos available') }}
    @endforelse

    <div x-intersect.full="$wire.fetch()"></div>
</x-wireuse::layout-container>
@endpersist
