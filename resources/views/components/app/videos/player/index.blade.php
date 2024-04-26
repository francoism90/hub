<div>
 {{-- It starts with one --}}
</div>

@script
    <script>
        Alpine.data('player', (manifest) => ({
            instance: undefined,
            ready: false,
            id: undefined,

            async init() {
                // Create instance
                this.instance = new window.shaka.Player();

                // Attach element
                await this.instance.attach(this.$refs.video);

                // Configure networking
                this.instance
                    .getNetworkingEngine()
                    .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true));

                // Set ready
                this.ready = true;
            },

            async destroy() {
                await stop()
            },

            async play() {
                try {
                    await this.instance.load(manifest);
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
                try {
                    this.$refs.video?.paused
                        ? await this.$refs.video?.play()
                        : await this.$refs.video?.pause()
                } catch (e) {
                    //
                }
            },
        }));
    </script>
@endscript
