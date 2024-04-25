@aware([
    'item',
])

<div
    x-data="player('{{ $item->preview }}')"
    x-ref="container"
    class="absolute z-10 mx-auto inset-x-0 h-screen w-3/5"
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
        class="w-full h-full bg-black"
    />
</div>
