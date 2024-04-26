<x-wireuse::layout-container
    x-data="scroll"
    class="h-[calc(100vh-4rem)] snap-mandatory snap-y overflow-y-scroll bg-black/25"
    fluid
>
    @forelse ($this->items as $item)
        <x-app.videos.feed.item :$item />
    @empty
        {{ __('No videos available') }}
    @endforelse

    <div x-intersect.full="loadMore"></div>

    <x-app.videos.player />
</x-wireuse::layout-container>

@script
    <script>
        Alpine.data('scroll', () => ({
            loadMore () {
                $wire.fetch();
            },
        }));
    </script>
@endscript
