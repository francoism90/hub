@props([
    'video',
])

<div
    x-data="play('{{ $video->stream }}')"
    x-ref="container"
    x-intersect:enter="load"
    x-intersect:leave="destroy"
    x-on:mousemove="showOverlay"
    x-on:click="showOverlay"
>
    <video
        x-cloak
        x-ref="video"
        x-show="ready"
        x-on:durationchange="handleEvent"
        x-on:play.debounce.100ms="handleEvent"
        x-on:playing.debounce.100ms="handleEvent"
        x-on:progress.debounce.100ms="handleEvent"
        x-on:timeupdate.debounce.100ms="handleEvent"
        class="w-full h-full absolute z-0 inset-0"
        playsinline
        {{-- autoplay --}}
    >
        <source />
    </video>

    <div
        x-cloak
        x-transition
        x-show="overlay"
    >
        <x-app.player.controls.seekbar :$video />
        <x-app.player.controls.panel :$video :$panel />
    </div>
</div>

@script
    <script data-navigate-track>
        Alpine.data('play', (manifest) => ({
            instance: undefined,
            manifest: undefined,
            ready: false,
            live: false,
            paused: true,
            overlay: false,
            idle: 0,
            duration: 0.0,
            currentTime: 0.0,
            buffered: 0.0,

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
            },

            async load() {
                // Load manifest
                await this.instance.load(this.manifest)

                // Set ready
                this.ready = true
            },

            async handleEvent(event) {
                switch(event.type) {
                    case 'durationchange':
                        this.duration = event.target.duration
                        break;
                    case 'progress':
                        this.buffered = event.target.buffered
                        break;
                }
            },

            async togglePlayback() {
                this.$refs.video.paused
                    ? await this.$refs.video.play()
                    : await this.$refs.video.pause()

                this.paused = this.$refs.video.paused
            },

            async showOverlay() {
                clearTimeout(this.idle);

                this.overlay = true
                this.idle = setTimeout(() => this.overlay = false, 1500)
            },

            async setCurrentTime(event) {
                this.$refs.video.currentTime = event.target.value
            },

            async destroy() {
                try {
                    await this.$refs.container?.unload()
                } catch (e) {
                    //
                }

                this.ready = false
            },
        }));
    </script>
@endscript
