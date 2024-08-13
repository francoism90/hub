@script
<script>
    Alpine.data("player", () => ({
        instance: undefined,
        show: false,

        async init() {
            // Make sure polyfills are always installed
            await window.shaka.polyfill.installAll();

            // Create instance
            await this.create();
        },

        async destroy() {
            this.show = false;

            await this.unload();
        },

        async create() {
            // Do not re-create instance
            if (this.instance !== undefined) {
                return;
            }

            // Create instance
            this.instance = new window.shaka.Player();

            // Configure player
            this.instance.configure({
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
                    dash: {
                        autoCorrectDrift: true,
                    },
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
            this.instance
                .getNetworkingEngine()
                .registerRequestFilter(
                    async (type, request) => (request.allowCrossSiteCredentials = true)
                );
        },

        async load(video, manifest) {
            if (this.instance === undefined) {
                console.error('Player does not exists');
                return;
            }

            try {
                // Load manifest
                await this.instance.attach(video);
                await this.instance.load(manifest);
            } catch (e) {}

            // Set ready state
            this.show = true;
        },

        async unload() {
            try {
                await this.instance?.detach();
            } catch (e) {}
        },
    }));
</script>
@endscript
