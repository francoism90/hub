<div>
 {{-- It starts with one --}}
</div>

@script
    <script>
        Alpine.data('player', (manifest) => ({
            instance: undefined,
            ready: false,
            open: false,

            async init() {
                // Create instance
                this.instance = new window.shaka.Player();

                // Attach element
                await this.instance.attach(this.$refs.video);

                // Configure networking
                this.instance
                    .getNetworkingEngine()
                    .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true));

                // Load manifest
                await this.instance.load(manifest);

                // Set ready
                this.ready = true;
            },

            async destroy() {
                await stop()
            },

            async play() {
                try {
                    if (! this.$refs.video?.paused) return;
                    await this.$refs.video?.play()
                } catch (e) {
                    //
                }
            },

            async stop() {
                try {
                    if (! this.$refs.video?.paused) {
                        await this.$refs.video?.pause()
                    }

                    await this.$refs.container?.unload()
                } catch (e) {
                    //
                }
            },

            async toggle() {
                this.open = ! this.open

                try {
                    this.open
                        ? await this.play()
                        : await this.stop()
                } catch (e) {
                    //
                }


            },
        }));
    </script>
@endscript
