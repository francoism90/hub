<div
    x-ref="container"
    x-data="{
        init() {
            const player = new window.shaka.Player($refs.video);

            player
                .getNetworkingEngine()
                .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true))

            @if ($controls)
                const ui = new shaka.ui.Overlay(player, $refs.container, $refs.video)
            @endif

            player.load('{{ $manifest }}')
        }
    }"
>
    <video
        {{ $attributes }}
        x-ref="video"
    />
</div>
