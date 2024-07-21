
@script
<script>
    Alpine.data("play", (manifest = null, startsAt = 0) => ({
        instance: undefined,
        manager: undefined,
        buffering: undefined,
        buffered: undefined,
        state: 'paused',
        ready: false,
        overlay: true,
        dialog: false,
        section: 0,
        synced: 0,
        fullscreen: false,
        idle: 0.0,
        duration: 0.0,
        currentTime: 0.0,

        async init() {
            // Create instance
            await this.create();

            // Load manifest
            await this.load(manifest, startsAt);
        },

        async destroy() {
            await this.unload();
        },

        async create() {
            // Make sure polyfills are always installed
            window.shaka.polyfill.installAll();

            // Do not re-create instance
            if (this.instance !== undefined && this.manager !== undefined) {
                return;
            }

            // Create instances
            this.instance = new window.shaka.Player();
            this.manager = new window.shaka.util.EventManager();

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

            // Set a synced reference time
            // this.synced = new Date().getTime();
        },

        async load(manifest = null, startsAt = 0) {
            if (this.instance === undefined) {
                console.error('Player does not exists');
                return;
            }

            try {
                const container = this.$refs.container;
                const video = this.$refs.video;

                // Set text displayer
                await this.instance.setVideoContainer(container)

                // Load manifest
                await this.instance.attach(video);
                await this.instance.load(manifest, startsAt);

                // Attach event listeners
                const onBuffering = (event) => {
                    this.buffering = this.instance.isBuffering();
                    this.buffered = this.instance.getBufferedInfo()?.total[0];
                };

                this.manager.listen(this.instance, 'statechanged', (event) => this.state = event.newstate);
                this.manager.listen(video, 'durationchange', (event) => this.duration = event.target.duration);
                this.manager.listen(video, 'timeupdate', (event) => this.currentTime = event.target.currentTime);
                this.manager.listen(video, 'progress', onBuffering);
                this.manager.listen(video, 'waiting', onBuffering);
            } catch (e) {}

            console.log(this.state)
        },

        async unload() {
            try {
                await this.manager?.release()();
                await this.instance?.detach();
            } catch (e) {}
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
