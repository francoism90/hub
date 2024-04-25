@aware([
    'item',
])

<div
    x-data="player('{{ $item->preview }}')"
    x-ref="container"
    class="h-full w-full bg-black"
>
    <video
        x-cloak
        x-ref="video"
        x-intersect:enter="play"
        x-intersect:leave="stop"
        x-on:click="toggle"
        playsinline
        autoplay
        muted
        class="w-full h-full"
    />
</div>
