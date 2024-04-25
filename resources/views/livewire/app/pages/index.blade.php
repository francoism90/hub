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
                    await this.instance.load(manifest);
                } catch (e) {
                    //
                }
            },

            async stop() {
                try {
                    if (! this.$refs.video?.paused) {
                        await this.$refs.video?.pause()
                    }

                    await this.$refs.container?.unload()
                } catch (e) {
                    //
                }
            },

            async toggle() {
                try {
                    this.$refs.video?.paused
                        ? await this.$refs.video?.play()
                        : await this.$refs.video?.pause()
                } catch (e) {
                    //
                }
            },
        }));
    </script>
@endscript
