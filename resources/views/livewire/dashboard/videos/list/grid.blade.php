<x-app.layout.container class="flex flex-col py-6 gap-y-6" fluid>
    {{-- <x-dashboard.videos.filters>
        @foreach($filters->all() as $action)
            <x-dynamic-component :component="$action->getComponent()" :$action />
        @endforeach
    </x-dashboard.videos.filters> --}}

    <main
        x-data="videos"
        class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
        wire:poll.visible.900s
    >
        @forelse ($this->items as $item)
            <x-dashboard.videos.content.item :$item />
        @empty
            No items found
        @endforelse
    </main>
</x-app.layout.container>

@script
    <script data-navigate-track>
        Alpine.data('videos', () => ({
            player: undefined,

            async init() {
                 // Install built-in polyfills
                window.shaka.polyfill.installAll()

                // Create instance
                this.player = new window.shaka.Player()

                // Configure networking
                this.player
                    .getNetworkingEngine()
                    .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true))
            },

            async destroy() {
                try {
                    await this.player?.unload()
                } catch (e) {
                    //
                }
            },


            async loadManifest(video, manifest) {
                if (! this.player) {
                    console.error('No player found');
                    return
                }

                try {
                    await this.player.attach(video)
                    await this.player.load(manifest)
                } catch(e) {
                    //
                }
            },
        }));
    </script>
@endscript
