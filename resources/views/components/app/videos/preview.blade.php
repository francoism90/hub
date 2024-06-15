@aware([
    'item',
])

<a
    wire:navigate
    href="{{ route('videos.view', $item) }}"
>
    <div
        x-data="preview"
        x-on:mouseover="load($refs.video, '{{ $item->preview }}')"
        x-on:mouseleave="destroy"
        x-on:touchstart.passive="load($refs.video, '{{ $item->preview }}')"
        x-on:touchend.passive="destroy"
        class="relative h-48 max-h-48 min-h-48 bg-black"
    >
        <img
            alt="{{ $item->title }}"
            crossorigin="use-credentials"
            loading="lazy"
            srcset="{{ $item->placeholder }}"
            src="{{ $item->thumbnail }}"
            class="rounded-xs h-full w-full object-fill"
        />

        <video
            x-cloak
            x-ref="video"
            x-show="show"
            x-transition
            class="rounded-xs absolute inset-0 z-30 h-full w-full object-fill"
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
    Alpine.data("preview", () => ({
        player: undefined,
        show: false,

        async init() {
            if (this.player !== undefined) return;

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
                .registerRequestFilter(
                    async (type, request) => (request.allowCrossSiteCredentials = true)
                );
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
            if (!this.player || !manifest.length) return;

            this.show = true;

            try {
                await this.player.attach(video);
                await this.player.load(manifest);
            } catch (e) {}
        },
    }));
</script>
@endscript
