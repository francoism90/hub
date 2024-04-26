@aware([
    'item',
])

<div
    x-data="player('{{ $item->preview }}')"
    x-ref="container"
    class="absolute inset-0 z-20 bg-black"
>
    <video
        x-cloak
        x-ref="video"
        x-intersect:leave="stop"
        x-on:click="toggle"
        playsinline
        muted
        class="w-full h-full"
    />
</div>
