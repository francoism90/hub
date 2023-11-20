<div
    wire:ignore
    x-data="player({{ Js::from(compact('manifest', 'controls', 'startsAt', 'rate')) }})"
    x-ref="container">
    <video
        x-ref="video"
        crossorigin="allow-credentials"
        playsinline
        {{ $attributes }} />
</div>

@script
    <script>
        Alpine.data('player', (options) => ({
            instance: null,
            ready: false,

            async init() {
                // Create instance
                this.instance = new window.shaka.Player()

                // // Configure elements
                await this.instance.attach(this.$refs.video);

                // Configure CORS
                this.instance
                    .getNetworkingEngine()
                    .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true));

                // Configure settings
                this.instance.configure({
                    preferredAudioLanguage: 'en',
                    preferredTextLanguage: 'en',
                    streaming: {
                        ignoreTextStreamFailures: true,
                        alwaysStreamText: true,
                    },
                });

                // Configure ui
                if (options.controls) {
                    this.ui()
                }

                // Load manifest
                await this.instance.load(options.manifest, options.startsAt);

                // Set ready
                this.ready = true
            },

            ui() {
                const ui = new shaka.ui.Overlay(this.instance, this.$refs.container, this.$refs.video);

                const replay = (video, step) => {
                    const el = document.createElement('button');

                    el.classList.add('material-icons-round', 'shaka-tooltip');
                    el.textContent = 'replay_10';

                    el.addEventListener('click', () => {
                        if (!video?.duration || video?.duration < step) {
                            return;
                        }

                        video.currentTime - step < video.duration ?
                            (video.currentTime -= step) :
                            (video.currentTime = video.duration - step);
                    });

                    return el;
                };

                const forward = (video, step) => {
                    const el = document.createElement('button');

                    el.classList.add('material-icons-round', 'shaka-tooltip');
                    el.textContent = 'forward_10';

                    el.addEventListener('click', () => {
                        if (!video?.duration || video?.duration < step) {
                            return;
                        }

                        video.currentTime + step < video.duration ?
                            (video.currentTime += step) :
                            (video.currentTime = video.duration - step);
                    });

                    return el;
                };

                ui.replay = class extends window.shaka.ui.Element {
                    constructor(parent, controls) {
                        super(parent, controls);
                        parent.appendChild(replay(this.video, 10));
                    }
                };

                ui.replay.Factory = class {
                    create(rootElement, controls) {
                        return new ui.replay(rootElement, controls);
                    }
                };

                ui.forward = class extends shaka.ui.Element {
                    constructor(parent, controls) {
                        super(parent, controls);
                        parent.appendChild(forward(this.video, 10));
                    }
                };

                ui.forward.Factory = class {
                    create(rootElement, controls) {
                        return new ui.forward(rootElement, controls);
                    }
                };

                window.shaka.ui.Controls.registerElement('replay', new ui.replay.Factory());
                window.shaka.ui.Controls.registerElement('forward', new ui.forward.Factory());

                // Configure UI
                ui.configure({
                    addBigPlayButton: false,
                    singleClickForPlayAndPause: false,
                    keyboardSeekDistance: 10,
                    fadeDelay: 3,
                    controlPanelElements: [
                        'play_pause',
                        'replay',
                        'forward',
                        'time_and_duration',
                        'spacer',
                        'fullscreen',
                        'overflow_menu',
                    ],
                    seekBarColors: {
                        base: 'rgba(255, 255, 255, 0.3)',
                        buffered: 'rgba(255, 255, 255, 0.54)',
                        played: 'rgba(236, 72, 153, 1)',
                    },
                });
            },

            async destroy() {
                if (this.$refs.video) {
                    this.$refs.video.pause()
                }
            },
        }))
    </script>
@endscript
