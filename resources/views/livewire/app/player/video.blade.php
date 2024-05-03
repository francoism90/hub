<div
    x-data="play"
    x-intersect:enter.full="load($refs.video, '{{ $video->stream }}')"
    x-intersect:leave.full="destroy"
    x-on:mousemove="showOverlay"
    x-on:touchmove="showOverlay"
    x-on:click="showOverlay"
>
    <video
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
        <source />
    </video>

    <x-app.player.controls :$video :$actions :$controls :$settings />
</div>

@script
<script>
    Alpine.data('play', () => ({
        player: undefined,
        overlay: false,
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

            // Configure networking
            this.player
                .getNetworkingEngine()
                .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true));
        },

        async destroy() {
            try {
                await this.player?.unload();
            } catch (e) {
                //
            }
        },

        async load(video, manifest) {
            if (!this.player) {
                console.error('No player found');
                return;
            }

            // Loading feedback
            this.showOverlay();

            try {
                await this.player.attach(video);
                await this.player.load(manifest, {{ $this->startsAt }});
            } catch (e) {
                //
            }
        },

        async handleEvent(event) {
            if (!event.target || !this.$refs.video) return;

            switch (event.type) {
                case 'durationchange':
                    this.duration = event.target.duration;
                    break;
                case 'progress':
                    this.buffered = event.target.buffered;
                    break;
                case 'play':
                case 'playing':
                case 'pause':
                    this.paused = this.$refs.video.paused;
                    break;
                case 'timeupdate':
                    this.currentTime = this.$refs.video.currentTime;

                    if (this.currentTime > 1)
                        $wire.updateHistory(this.currentTime)
                    break;
                default:
                    console.error('Unhandled event: ' + event.type);
            }
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
            this.idle = setTimeout(() => (this.overlay = false), 2500);
        },

        async forceOverlay() {
            clearTimeout(this.idle);

            this.overlay = true;
        },

        async seekTo(event) {
            this.$refs.video.currentTime = event.target.value;
        },
    }));
</script>
@endscript
