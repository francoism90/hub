@persist('scrollbar')
<x-app.layout.container
    x-data="feed"
    class="relative h-[calc(100vh-4rem)] w-dvw snap-mandatory snap-y overflow-y-scroll bg-black/25"
    fluid
    wire:scroll
>
    @forelse ($this->items as $item)
        <article class="relative w-full h-full snap-center">
            @if ($item->getMorphClass() === 'video')
                <livewire:livewire.feed.video :video="$item" :key="$item->getRouteKey()" />
            @endif
        </article>
    @empty
        {{ __('Please come back later!') }}
    @endforelse

    <div x-intersect.full="$wire.fetch()"></div>
</x-app.layout.container>
@endpersist

@script
    <script data-navigate-track>
        Alpine.data('feed', () => ({
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
                    return;
                }

                try {
                    await this.player.attach(video)
                    await this.player.load(manifest)
                } catch(e) {

                }
            },
        }));
    </script>
@endscript
