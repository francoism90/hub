@props([
    'video',
])

<div
    x-data="play('{{ $video->stream }}')"
    x-ref="container"
    x-intersect:enter="load"
    x-intersect:leave="destroy"
>
    <video
        x-cloak
        x-ref="video"
        x-show="ready"
        x-on:durationchange="handleEvent"
        x-on:progress.debounce.100ms="handleEvent"
        x-on:timeupdate.debounce.100ms="handleEvent"
        class="w-full h-full absolute z-0 inset-0"
        playsinline
        autoplay
    >
        <source />
    </video>

    <x-app.player.controls.seekbar :$video />
    <x-app.player.controls.panel :$video />
</div>

@script
    <script data-navigate-track>
        Alpine.data('play', (manifest) => ({
            instance: undefined,
            manifest: undefined,
            ready: false,
            live: false,
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
