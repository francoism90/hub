@script
<script>
    Alpine.data("preview", () => ({
        instance: undefined,
        ready: false,

        async init() {
            await this.create();
        },

        async destroy() {
            await this.unload();
        },

        async create() {
            // Do not re-create instance
            if (this.instance !== undefined) {
                return;
            }

            // Install polyfills to patch browser incompatibilities
            await window.shaka.polyfill.installAll();

            // Create instance
            this.instance = new window.shaka.Player();

            // Configure player
            this.instance.configurationForLowLatency({
                manifest: {
                    disableAudio: true,
                    disableText: true,
                    disableThumbnails: true,
                },
            });

            // Configure networking
            this.instance.getNetworkingEngine().registerRequestFilter(
                async (type, request) => (request.allowCrossSiteCredentials = true)
            );
        },

        async load(video = undefined, manifest = null) {
            // Do not load if elements are not defined
            if (video === undefined || manifest === null) {
                return;
            }

            try {
                // Make sure player exists
                await this.create();

                // Load manifest
                await this.instance.attach(video);
                await this.instance.load(manifest);
            } catch (e) {}

            // Set ready state
            this.ready = true;
        },

        async unload() {
            // Set ready state
            this.ready = false;

            // Do not unload if instance is not defined
            if (this.instance === undefined) {
                return;
            }

            try {
                await this.instance.detach();
            } catch (e) {}
        },
    }));
</script>
@endscript
