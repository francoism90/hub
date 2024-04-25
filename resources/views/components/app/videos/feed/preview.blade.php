@aware([
    'item',
])

<div
    x-data="player('{{ $item->preview }}')"
    x-ref="container"
    class="absolute z-10 m-auto inset-x-0 h-screen w-3/5"
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
        class="bg-black w-full h-full"
    />
</div>
