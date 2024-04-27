@props([
    'video',
])

<div
    x-data="play('{{ $video->stream }}')"
    x-ref="container"
>
    <video
        x-cloak
        x-ref="video"
        x-show="ready"
        x-on:durationchange="handleEvent"
        x-on:progress="handleEvent"
        x-on:timeupdate.debounce.100ms="handleEvent"
        class="absolute z-0 w-full h-full"
        playsinline
    >
        <source src="" />
    </video>

    <x-app.player.controls.seekbar :$video />
    <x-app.player.controls.panel :$video />
</div>

@script
    <script data-navigate-track>
        Alpine.data('play', (manifest) => ({
            instance: undefined,
            ready: false,
            live: false,
            duration: 0.0,
            currentTime: 0.0,
            buffered: 0.0,

            async init() {
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

            async setCurrentTime(event) {
                this.$refs.video.currentTime = event.target.value
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
