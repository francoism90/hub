@script
<script>
    Alpine.data("preview", () => ({
        instance: undefined,
        ready: false,

        async init() {
            // Make sure polyfills are always installed
            await window.shaka.polyfill.installAll();

            // Create instance
            await this.create();
        },

        async destroy() {
            this.ready = false;

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
        },

        async load(video = undefined, manifest = null) {
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
            try {
                await this.instance?.detach();
            } catch (e) {}
        },
    }));
</script>
@endscript
