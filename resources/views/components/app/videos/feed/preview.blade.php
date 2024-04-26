@aware([
    'item',
])

<div
    x-data="player('{{ $item->preview }}')"
    x-ref="container"
    class="absolute inset-y-0 inset-x-0 sm:inset-x-10 z-20 bg-black"
>
    <video
        x-cloak
        x-ref="video"
        x-intersect:enter="play"
        x-intersect:leave="stop"
        x-on:click="toggle"
        playsinline
        {{-- autoplay --}}
        muted
        class="w-full h-full"
    />
</div>
