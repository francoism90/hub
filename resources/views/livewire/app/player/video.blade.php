<div
    wire:ignore
    x-data="play"
    x-intersect:enter.full="load($refs.video, '{{ $video->stream }}')"
    x-intersect:leave.full="destroy"
    x-on:mousemove="showOverlay"
    x-on:touchmove="showOverlay"
    x-on:click="showOverlay"
    class="relative h-screen w-screen"
>
    <video
        x-cloak
        x-ref="video"
        x-on:durationchange="handleEvent"
        x-on:play="handleEvent"
        x-on:playing="handleEvent"
        x-on:pause="handleEvent"
        x-on:progress.debounce.200ms="handleEvent"
        x-on:timeupdate.debounce.200ms="handleEvent"
        class="absolute inset-0 z-0 h-full w-full"
        playsinline
        autoplay
    >
        <source src="" />
    </video>

    <x-app.player.controls :$video :$actions :$controls :$settings />
</div>

@script
<script>
    Alpine.data('play', () => ({
        player: undefined,
        overlay: true,
        dialog: false,
        section: 0,
        paused: true,
        fullscreen: false,
        idle: 0,
        duration: 0.0,
        currentTime: 0.0,
        seekTime: 0.0,
        buffered: 0.0,

        async init() {
            // Install built-in polyfills
            window.shaka.polyfill.installAll();

            // Create instance
            this.player = new window.shaka.Player();

            // Configure player
            this.player.configure({
                streaming: {
                    autoLowLatencyMode: true,
                    ignoreTextStreamFailures: true,
                    segmentPrefetchLimit: 2,
                    retryParameters: {
                        baseDelay: 100,
                    },
                },
                manifest: {
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
            clearTimeout(this.idle);

            try {
                await this.player?.unload();
            } catch (e) {
                //
            }
        },

        async load(video, manifest) {
            if (! this.player || ! manifest.length)
                return;

            this.showOverlay();

            try {
                // Load manifest
                await this.player.attach(video);
                await this.player.load(manifest, {{ $this->startsAt }});

                // Select tracks
                if ($wire && $wire.captions) {
                    await this.player.selectTextLanguage('en', 'subtitle')
                    await this.player.setTextTrackVisibility(true)
                }
            } catch (e) {
                //
            }
        },

        async handleEvent(event) {
            if (!event.target || !this.$refs.video)
                return;

            switch (event.type) {
                case 'durationchange':
                    this.duration = event.target.duration || 0.0;
                    break;
                case 'progress':
                    this.buffered = event.target.buffered || 0.0;
                    break;
                case 'play':
                case 'playing':
                case 'pause':
                    this.paused = this.$refs.video.paused;
                    break;
                case 'timeupdate':
                    const currentTime = this.$refs.video.currentTime;

                    if (currentTime > 0) {
                        this.currentTime = currentTime;
                        await $wire.updateHistory(currentTime);
                    }
                    break;
                default:
                    console.debug('Unhandled event: ' + event.type);
            }
        },

        async toggleDialog(index = 0) {
            this.section = index;
            this.dialog = ! this.dialog;
        },

        async togglePlayback() {
            this.$refs.video.paused
                ? await this.$refs.video.play()
                : await this.$refs.video.pause();
        },

        async toggleFullscreen() {
            document.fullscreenElement
                ? await document.exitFullscreen()
                : await document.documentElement.requestFullscreen();

            this.fullscreen = document.fullscreenElement;
        },

        async showOverlay() {
            clearTimeout(this.idle);

            this.overlay = true;
            this.idle = setTimeout(() => (this.overlay = false), 3500);
        },

        async forceOverlay() {
            clearTimeout(this.idle);
            this.overlay = true;
        },

        async seekTo(event) {
            this.$refs.video.currentTime = event.target.value;
        },

        async backward() {
            if (! this.$refs.video) return
            this.$refs.video.currentTime -= 10;
        },

        async forward() {
            if (! this.$refs.video) return
            this.$refs.video.currentTime += 10;
        },

        async setTextTrack(track = 0) {
            if (! this.player || track < 0)
                return;

            try {
                await this.player.selectTextTrack(track)
                await this.player.setTextTrackVisibility(true)
            } catch {
                //
            }
        }
    }));
</script>
@endscript
