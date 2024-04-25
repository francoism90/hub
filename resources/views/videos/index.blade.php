<x-wireuse::layout-container
    x-data="scroll"
    class="w-screen h-screen max-h-[calc(100dvh-65px)] snap-mandatory snap-y overflow-y-scroll bg-black/25"
    fluid
>
    @forelse ($this->items as $item)
        <x-app.videos.feed.item :$item />
    @empty
        {{ __('No videos available') }}
    @endforelse

    <div x-intersect.full="loadMore"></div>
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
