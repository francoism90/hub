
@script
<script>
    Alpine.data("play", (manifest = null, startsAt = 0) => ({
        ready: false,
        instance: undefined,
        manager: undefined,
        state: 'paused',
        stats: undefined,
        buffering: false,
        buffered: undefined,
        duration: 0.0,
        currentTime: 0.0,
        fullscreen: false,
        overlay: true,
        dialog: false,
        section: 0,
        idle: 0.0,

        async init() {
            // Create instance
            await this.create();

            // Load manifest
            await this.load(manifest, startsAt);
        },

        async destroy() {
            this.ready = false;

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

                // Set default tracks
                if ($wire !== undefined && $wire.caption?.length) {
                    await this.instance.selectTextLanguage($wire.caption, 'subtitle')
                    await this.instance.setTextTrackVisibility(true)
                }

                // Attach event listeners
                const onBuffering = (event) => {
                    const stats = this.instance.getStats();

                    this.buffering = this.instance.isBuffering();
                    this.buffered = this.instance.getBufferedInfo()?.total[0];
                    this.stats = window.pick(stats, ['width', 'height', 'streamBandwidth']);
                };

                this.manager.listen(this.instance, 'mediaqualitychanged', onBuffering);
                this.manager.listen(this.instance, 'statechanged', (event) => this.state = event.newstate);
                this.manager.listen(video, 'durationchange', (event) => this.duration = event.target.duration);
                this.manager.listen(video, 'timeupdate', (event) => this.currentTime = event.target.currentTime);
                this.manager.listen(video, 'progress', onBuffering);
                this.manager.listen(video, 'waiting', onBuffering);

                this.ready = true;
            } catch (e) {}
        },

        async unload() {
            try {
                await this.manager?.release();
                await this.instance?.detach();
            } catch (e) {}
        },

        async sync() {
            const currentTime = this.instance?.getMediaElement().currentTime;

            if (currentTime >= 0 && $wire?.updateHistory !== undefined) {
                await $wire.updateHistory(currentTime);
            }
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
            this.instance.getMediaElement().paused
                ? await this.instance.getMediaElement().play()
                : await this.instance.getMediaElement().pause();
        },

        async seekTo(event) {
            const range = this.instance?.seekRange();
            const time = event.target?.value || 0;

            if (range !== undefined && time >= range.start && time <= range.end) {
                this.instance.getMediaElement().currentTime = time;
            }
        },

        async backward() {
            this.instance.getMediaElement().currentTime -= 10;
        },

        async forward() {
            this.instance.getMediaElement().currentTime += 10;
        },

        async setTextTrack(trackId = 0) {
            if (trackId < 0) {
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
