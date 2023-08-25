<div
    class="h-full w-full"
    x-data="{
        init() {
            const player = new window.shaka.Player($refs.container);

            player
                .getNetworkingEngine()
                .registerRequestFilter(async (type, request) => (request.allowCrossSiteCredentials = true))

            player.load('{{ $item->preview }}')
        }
    }"
>
    <video
        {{ $attributes }}
        x-ref="container"
        class="bg-black"
        muted
        loop
    />
</div>
