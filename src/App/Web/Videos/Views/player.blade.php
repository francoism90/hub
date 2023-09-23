<div
    wire:ignore
    x-ref="container"
    x-data="{
        init() {
            const player = new window.shaka.Player($refs.video);
    
            player
                .getNetworkingEngine()
                .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true))
    
            @if($controls)
            // Create controls
            const replay = (video, step) => {
                const el = document.createElement('button')
    
                el.classList.add('material-icons-round', 'shaka-tooltip')
                el.textContent = 'replay_10'
    
                el.addEventListener('click', () => {
                    if (!video?.duration || video?.duration < step) {
                        return
                    }
    
                    video.currentTime - step < video.duration ?
                        (video.currentTime -= step) :
                        (video.currentTime = video.duration - step)
                })
    
                return el
            }
    
            const forward = (video, step) => {
                const el = document.createElement('button')
    
                el.classList.add('material-icons-round', 'shaka-tooltip')
                el.textContent = 'forward_10'
    
                el.addEventListener('click', () => {
                    if (!video?.duration || video?.duration < step) {
                        return
                    }
    
                    video.currentTime + step < video.duration ?
                        (video.currentTime += step) :
                        (video.currentTime = video.duration - step)
                })
    
                return el
            }
    
            // Setup UI
            const ui = new shaka.ui.Overlay(player, $refs.container, $refs.video)
    
            ui.replay = class extends window.shaka.ui.Element {
                constructor(parent, controls) {
                    super(parent, controls)
                    parent.appendChild(replay($refs.video, 10))
                }
            }
    
            ui.replay.Factory = class {
                create(rootElement, controls) {
                    return new ui.replay(rootElement, controls)
                }
            }
    
            ui.forward = class extends shaka.ui.Element {
                constructor(parent, controls) {
                    super(parent, controls)
                    parent.appendChild(forward($refs.video, 10))
                }
            }
    
            ui.forward.Factory = class {
                create(rootElement, controls) {
                    return new ui.forward(rootElement, controls)
                }
            }
    
            window.shaka.ui.Controls.registerElement('replay', new ui.replay.Factory())
            window.shaka.ui.Controls.registerElement('forward', new ui.forward.Factory())
    
            // Configure UI
            ui.configure({
                addBigPlayButton: false,
                singleClickForPlayAndPause: false,
                keyboardSeekDistance: 10,
                controlPanelElements: [
                    'play_pause',
                    'replay',
                    'forward',
                    'time_and_duration',
                    'spacer',
                    'fullscreen',
                    'overflow_menu'
                ],
                seekBarColors: {
                    base: 'rgba(255, 255, 255, 0.3)',
                    buffered: 'rgba(255, 255, 255, 0.54)',
                    played: 'rgba(236, 72, 153, 1)'
                }
            })
            @endif
    
            // Load manifest
            player.load('{{ $manifest }}', {{ $startsAt }})
    
            // Apply playback rate
            $refs.video.defaultPlaybackRate = {{ $rate }};
        }
    }">

    <video
        x-ref="video"
        crossorigin="allow-credentials"
        playsinline
        {{ $attributes }} />
</div>
