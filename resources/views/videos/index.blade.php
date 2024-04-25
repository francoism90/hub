<x-wireuse::layout-container
    x-data="scroll"
    {{-- @wheel.self.throttle="wheel"
    @touchmove.self.throttle="start" --}}
    class="w-screen h-screen max-h-[calc(100dvh-65px)] snap-mandatory snap-y overflow-y-scroll bg-black/25"
    fluid
>
    @forelse ($this->items as $item)
        <x-app.videos.feed.item :$item />

        <div x-intersect.full="next"></div>
    @empty
        {{ __('No videos available') }}
    @endforelse
</x-wireuse::layout-container>

@script
    <script>
        Alpine.data('scroll', () => ({
            init () {
                // console.log(show)
            },

            next () {
                console.log('next')
            },

            wheel(event) {
                const deltaY = Math.sign(event.deltaY || 0)

                return deltaY > 0
                    ? $wire.next()
                    : $wire.previous()
            },
        }));
    </script>
@endscript
