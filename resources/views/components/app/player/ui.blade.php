@script
<script>
    Alpine.data("player", () => ({
        instance: undefined,
        manager: undefined,
        ready: false,
        state: 'paused',
        stats: undefined,
        buffering: false,
        buffered: undefined,
        duration: 0.0,
        currentTime: 0.0,
        textTrack: $wire.entangle('caption'),
        fullscreen: false,
        overlay: true,
        idle: 0.0,

        async init() {
            // Install polyfills to patch browser incompatibilities
            await window.shaka.polyfill.installAll();

            // Create instances
            await this.create();

            // Init watchers
            this.$watch('textTrack', () => this.setTextTrack());
        },

        async destroy() {
            await this.unload();
        },

        async create() {
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
                    ignoreTextStreamFailures: true,
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
            this.instance.getNetworkingEngine().registerRequestFilter(
                async (type, request) => (request.allowCrossSiteCredentials = true)
            );
        },

        async load(manifest = null, timecode = null) {
            const container = this.$refs.container;
            const video = this.$refs.video;

            // Do not load if elements are not defined
            if (container === undefined || video === undefined) {
                return;
            }

            try {
                const h = Alpine.throttle(() => this.sync(), 800);

                // Make sure player exists
                await this.create();

                // Load manifest
                await this.instance.attach(video);
                await this.instance.load(manifest, timecode);

                // Set tracks
                await this.setTextTrack();

                // Attach event listeners
                const onBuffering = (event) => {
                    if (this.instance === undefined) {
                        return;
                    }

                    this.buffering = this.instance.isBuffering();
                    this.buffered = this.instance.getBufferedInfo()?.total[0];
                    this.stats = this.instance.getStats();
                };

                const onTimeUpdate = (event) => {
                    this.currentTime = event.target.currentTime;
                    h();
                };

                this.manager.listen(this.instance, 'mediaqualitychanged', onBuffering);
                this.manager.listen(this.instance, 'statechanged', (event) => this.state = event.newstate);
                this.manager.listen(video, 'durationchange', (event) => this.duration = event.target.duration);
                this.manager.listen(video, 'timeupdate', onTimeUpdate);
                this.manager.listen(video, 'progress', onBuffering);
                this.manager.listen(video, 'waiting', onBuffering);

                // Set ready state
                this.ready = true;
            } catch (e) {}
        },

        async unload() {
            // Set ready state
            this.ready = false;

            // Do not unload if instance is not defined
            if (this.instance === undefined || this.manager === undefined) {
                return;
            }

            try {
                await this.manager.release();
                await this.instance.detach();
            } catch (e) {}
        },

        async sync() {
            if ($wire.syncSession === undefined || this.instance === undefined) {
                return;
            }

            await $wire.syncSession(this.currentTime);
        },

        async toggleFullscreen() {
            try {
                const element = this.$refs.container;

                if (document.fullscreenElement) {
                    await document.exitFullscreen();
                    await screen.orientation.unlock();
                } else {
                    await element.requestFullscreen();
                    await screen.orientation.lock('landscape');
                }
            } catch (e) {}

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
            const range = this.instance?.seekRange();

            if (range !== undefined) {
                this.instance.getMediaElement().currentTime -= 10;
            }
        },

        async forward() {
            const range = this.instance?.seekRange();

            if (range !== undefined) {
                this.instance.getMediaElement().currentTime += 30;
            }
        },

        async getTextTracks() {
            return this.instance?.getTextTracks() || [];
        },

        async setTextTrack() {
            // Do not set text track if instance is not defined
            if (this.instance === undefined) {
                return;
            }

            this.textTrack = parseInt(this.textTrack || -1)

            const tracks = await this.getTextTracks();
            const track = tracks.find(o => o.id === this.textTrack);

            if (tracks.length && track?.id) {
                await this.instance.selectTextTrack(track.id);
                await this.instance.setTextTrackVisibility(true);
            }
        }
    }));
</script>
@endscript
