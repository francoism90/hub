<x-wireuse::layout-container x-data="scroll" fluid>
    @forelse ($this->items as $item)
        <x-app.videos.feed :$item>
            <x-app.videos.feed.item />
        </x-app.videos.feed>
    @empty
        {{ __('No videos available') }}
    @endforelse


</x-wireuse::layout-container>

@script
    <script>
        Alpine.data('scroll', () => ({
            start(event) {
                const deltaY = Math.sign(event.deltaY || 0)

                return deltaY > 0
                    ? $wire.next()
                    : $wire.previous()
            },
        }));
    </script>
@endscript
