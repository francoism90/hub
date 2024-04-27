@props([
    'video',
])

<a
    wire:navigate
    href="{{ route('videos.view', $video) }}"
>
    <div
        x-data="preview('{{ $video->preview }}')"
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

        <div class="absolute top-10 left-10">
        Previews: <span x-text="$wire.$parent.preview" />
        </div>

        <video
            x-cloak
            x-ref="video"
            x-show="ready && $wire.$parent.preview"
            class="h-full w-full absolute inset-0 z-40 brightness-90"
            playsinline
            muted
            autoplay
            loop
        >
            <source src="" />
        </video>
    </div>
</a>

@script
    <script data-navigate-track>
        Alpine.data('preview', (manifest) => ({
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
