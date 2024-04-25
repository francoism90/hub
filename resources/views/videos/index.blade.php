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

@script
    <script>
        Alpine.data('player', (manifest) => ({
            instance: null,
            ready: false,
            open: false,

            async init() {
                // Create instance
                this.instance = new window.shaka.Player();

                // Attach element
                await this.instance.attach(this.$refs.video);

                // Configure networking
                this.instance
                    .getNetworkingEngine()
                    .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true));

                // Set ready
                this.ready = true;
            },

            async destroy() {
                await stop()
            },

            async play() {
                try {
                    if (this.ready && this.open) return;

                    await this.instance.load(manifest);
                } catch (e) {
                    //
                }

                this.open = true
            },

            async stop() {
                try {
                    if (this.video?.playing) {
                        await this.video?.pause()
                    }

                    await this.container?.unload()
                } catch (e) {
                    //
                }

                this.open = false
            },
        }));
    </script>
@endscript
