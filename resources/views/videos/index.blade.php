<x-wireuse::layout-container x-data="scroll" fluid>
    @if ($video)
        <x-app.videos.feed :$video>
            <x-app.videos.feed.item />
        </x-app.videos.feed>
    @else
        {{ __('No videos available') }}
    @endif
</x-wireuse::layout-container>

@script
    <script>
        Alpine.data('scroll', () => ({
            start() {
                $wire.refresh()
            },
        }));
    </script>
@endscript
