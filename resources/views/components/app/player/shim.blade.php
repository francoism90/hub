@script
<script>
    Alpine.data("player", () => ({
        instance: undefined,
        show: false,

        async init() {
            // Make sure polyfills are always installed
            window.shaka.polyfill.installAll();

            // Do not re-create instance
            if (this.instance !== undefined) {
                return;
            }

            console.log('create')

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

        async destroy() {
            this.show = false;

            if (this.instance === undefined) {
                return;
            }

            try {
                await this.instance.unload();
            } catch (e) {
                //
            }
        },

        async load(video, manifest) {
            if (this.instance === undefined) {
                return;
            }

            console.log(this.instance.getManifest())

            try {
                await this.instance.attach(video);
                await this.instance.load(manifest);

                this.show = true;
            } catch (e) {}
        },
    }));
</script>
@endscript
