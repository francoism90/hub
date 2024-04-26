@props([
    'video',
    'preview',
])

<a
    wire:navigate
    href="{{ route('videos.view', $video) }}"
>
    <div
        x-data="player('{{ $video->preview }}')"
        x-ref="container"
        x-intersect:enter="load"
        x-intersect:leave="destroy"
        class="absolute z-20 inset-y-0 inset-x-0 bg-black/25 sm:inset-x-10 sm:bg-black"
    >
        <img
            alt="{{ $video->title }}"
            srcset="{{ $video->placeholder }}"
            src="{{ $video->thumbnail }}"
            class="h-full w-full brightness-90 object-contain"
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
                'h-full w-full absolute inset-0 z-40 brightness-90' => $preview,
                'hidden' => ! $preview,
            ])
        >
            <source src="" />
        </video>
    </div>
</a>

@script
    <script>
        Alpine.data('player', (manifest) => ({
            instance: undefined,
            manifest: undefined,
            ready: false,

            async init() {
                this.ready = false
                this.manifest = manifest

                // Create instance
                this.instance = new window.shaka.Player()

                // Configure networking
                this.instance
                    .getNetworkingEngine()
                    .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true))

                 // Attach element
                await this.instance.attach(this.$refs.video)

                // Set ready
                this.ready = true
            },

            async load() {
                await this.instance.load(this.manifest)
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
