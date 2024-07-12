
@script
<script>
    Alpine.data("play", (manifest = null, startsAt = 0) => ({
        instance: undefined,
        ready: false,
        overlay: true,
        dialog: false,
        section: 0,
        paused: true,
        fullscreen: false,
        idle: 0.0,
        duration: 0.0,
        currentTime: 0.0,
        seekTime: 0.0,
        buffered: 0.0,

        async init() {
            // Create instance
            await this.create();

            // Load manifest
            await this.load(this.$refs.video, manifest, startsAt);
        },

        async destroy() {
            this.ready = false;

            if (this.instance === undefined) {
                return;
            }

            try {
                await this.instance.unload();
            } catch (e) {
                //
            }
        },

        async create() {
            // Make sure polyfills are always installed
            window.shaka.polyfill.installAll();

            // Do not re-create instance
            if (this.instance !== undefined) {
                return;
            }

            // Create instance
            this.instance = new window.shaka.Player();

            // Configure player
            this.instance.configure({
                streaming: {
                    autoLowLatencyMode: true,
                    ignoreTextStreamFailures: true,
                    segmentPrefetchLimit: 2,
                    retryParameters: {
                        baseDelay: 100,
                    },
                },
                manifest: {
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
                await this.create();
            }

            try {
                // Load manifest
                await this.instance.attach(video);
                await this.instance.load(manifest, startsAt);

                // Select tracks
                if ($wire !== undefined && $wire.caption?.length) {
                    await this.instance.selectTextLanguage($wire.caption, 'subtitle')
                    await this.instance.setTextTrackVisibility(true)
                }
            } catch (e) {}

            this.ready = true;
        },

        async unload() {
            this.ready = false

            if (this.instance === undefined) {
                return;
            }

            try {
                await this.instance.unload();
            } catch (e) {}
        },

        async handleEvent(event) {
            if (event === undefined || this.instance === undefined || this.$refs.video === undefined) {
                return;
            }

            switch (event.type) {
                case 'durationchange':
                    this.duration = event.target.duration || 0.0;
                    break;
                case 'progress':
                    this.buffered = event.target.buffered || 0.0;
                    break;
                case 'play':
                case 'playing':
                case 'pause':
                    this.paused = this.$refs.video.paused;
                    break;
                case 'timeupdate':
                    const currentTime = this.$refs.video.currentTime;

                    if (currentTime > 0) {
                        this.currentTime = currentTime;

                        if ($wire !== undefined && $wire.updateHistory !== undefined) {
                            await $wire.updateHistory(currentTime);
                        }
                    }
                    break;
                default:
                    console.debug('Unhandled event: ' + event.type);
            }
        },

        async toggleDialog(index = 0) {
            this.section = index;
            this.dialog = ! this.dialog;
        },

        async toggleFullscreen() {
            const element = this.$refs.container;

            document.fullscreenElement
                ? await document.exitFullscreen()
                : await element.requestFullscreen();

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

        async togglePlayback() {
            if (this.$refs.video === undefined) {
                return;
            }

            this.$refs.video.paused
                ? await this.$refs.video.play()
                : await this.$refs.video.pause();
        },

        async seekTo(event) {
            if ((time = event.target?.value) && time >= 0) {
                this.$refs.video.currentTime = time;
            }
        },

        async backward() {
            if (this.$refs.video?.currentTime !== undefined) {
                this.$refs.video.currentTime -= 10;
            }
        },

        async forward() {
            if (this.$refs.video?.currentTime !== undefined) {
                this.$refs.video.currentTime += 10;
            }
        },

        async setTextTrack(trackId = 0) {
            if (trackId < 0 || this.instance === undefined) {
                return;
            }

            try {
                await this.instance.selectTextTrack(trackId)
                await this.instance.setTextTrackVisibility(true)
            } catch (e) {}
        }
    }));
</script>
@endscript
