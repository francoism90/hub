@props([
    'video',
    'preview',
])

<div x-data="player('{{ $video->preview }}')">
    <div
        x-ref="container"
        x-intersect:leave="destroy"
        class="absolute z-20 inset-y-0 inset-x-0 bg-black/25 sm:inset-x-10 sm:bg-black"
    >
        <img
            alt="{{ $video->title }}"
            srcset="{{ $video->placeholder }}"
            src="{{ $video->thumbnail }}"
            class="h-full w-full object-contain"
            crossorigin="use-credentials"
            loading="lazy"
        />

        <video
            x-cloak
            x-ref="video"
            x-show="ready"
            playsinline
            muted
            autoplay
            loop
            @class([
                'h-full w-full absolute inset-0 z-40' => $preview,
                'hidden' => ! $preview,
            ])
        />
    </div>
</div>

@script
    <script>
        Alpine.data('player', (manifest, preview) => ({
            instance: undefined,
            ready: false,

            async init() {
                // Reset ready
                this.ready = false

                // Create instance
                this.instance = new window.shaka.Player()

                // Configure networking
                this.instance
                    .getNetworkingEngine()
                    .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true))

                 // Attach element
                await this.instance.attach(this.$refs.video)

                // Load manifest
                await this.instance.load(manifest)

                // Set ready
                this.ready = true
            },

            async destroy() {
                try {
                    if (! this.$refs.video?.paused) {
                        await this.$refs.video?.pause()
                    }

                    await this.$refs.container?.unload()
                } catch (e) {
                    //
                }

                this.ready = false
            },
        }));
    </script>
@endscript
