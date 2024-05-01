@persist('scrollbar')
<div
    x-data="feed"
    class="relative h-dvh w-screen snap-mandatory snap-y overflow-y-scroll bg-black/25"
    fluid
    wire:scroll
>
    @forelse ($this->items as $item)
        @if ($item->getMorphClass() === 'video')
            <livewire:livewire.feed.video :video="$item" :key="$item->getRouteKey()" />
        @endif
    @empty
        {{ __('Please checkout later') }}
    @endforelse

    <div x-intersect.full="$wire.fetch()"></div>
</div>
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
                    return
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
