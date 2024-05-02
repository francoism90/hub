@props([
    'video',
])

<a wire:navigate href="{{ route('videos.view', $video) }}">
    <div
        x-data="video"
        class="relative flex h-full w-full items-center justify-center"
    >

        <img
            alt="{{ $video->title }}"
            crossorigin="use-credentials"
            loading="lazy"
            srcset="{{ $video->placeholder }}"
            src="{{ $video->thumbnail }}"
            class="absolute z-10 h-72 min-h-72 max-h-72 w-full"
        />

        <video
            x-ref="video"
            x-intersect:enter.full="load($refs.video, '{{ $video->preview }}')"
            x-intersect:leave.full="destroy"
            x-show="$wire.$parent.preview"
            class="z-20 h-72 min-h-72 max-h-72 w-full object-fill"
            playsinline
            muted
            autoplay
            loop
        >
            <source />
        </video>
    </div>
</a>

@script
    <script data-navigate-track>
        Alpine.data('video', () => ({
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

            async load(video, manifest) {
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
