<x-wireuse::layout-container class="flex flex-col gap-y-3 p-3" fluid>
    <x-dashboard.videos.filters>
        @foreach($filters->all() as $action)
            <x-dynamic-component :component="$action->getComponent()" :$action />
        @endforeach
    </x-dashboard.videos.filters>

    <main
        wire:poll.visible.900s
        class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 md:grid-cols-3"
    >
        @forelse ($this->items as $item)
            <x-dashboard.videos.content.item :$item />
        @empty
            No items found
        @endforelse
    </main>
</x-wireuse::layout-container>

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

            async start() {
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
