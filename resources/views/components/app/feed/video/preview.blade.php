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
            class="absolute z-10 h-80 max-h-80 min-h-80 w-full"
        />

        <video
            x-cloak
            x-ref="video"
            x-show="$wire.$parent.preview"
            x-transition
            x-intersect:enter.full="load($refs.video, '{{ $video->preview }}')"
            x-intersect:leave.full="destroy"
            class="z-20 h-80 max-h-80 min-h-80 w-full object-fill"
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
<script>
    Alpine.data('video', () => ({
        player: undefined,
        show: false,

        async init() {
            if (this.player !== undefined)
                return;

            // Install built-in polyfills
            window.shaka.polyfill.installAll();

            // Create instance
            this.player = new window.shaka.Player();

            // Configure player
            this.player.configure({
                streaming: {
                    lowLatencyMode: true,
                    ignoreTextStreamFailures: true,
                    inaccurateManifestTolerance: 0,
                    rebufferingGoal: 0.01,
                    segmentPrefetchLimit: 2,
                    updateIntervalSeconds: 0.1,
                    retryParameters: {
                        baseDelay: 100,
                    },
                },
                manifest: {
                    disableAudio: true,
                    disableThumbnails: true,
                    retryParameters: {
                        baseDelay: 100,
                    },
                },
                drm: {
                    retryParameters: {
                        baseDelay: 100,
                    },
                },
            });

            // Configure networking
            this.player
                .getNetworkingEngine()
                .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true));
        },

        async destroy() {
            this.show = false;

            try {
                await this.player?.unload();
            } catch (e) {
                //
            }
        },

        async load(video, manifest) {
            if (! this.player || ! manifest.length)
                return;

            this.show = true;

            try {
                await this.player.attach(video);
                await this.player.load(manifest);
            } catch (e) {}
        },
    }));
</script>
@endscript
