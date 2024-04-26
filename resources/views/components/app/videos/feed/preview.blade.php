@props([
    'video',
])

<div
    x-data="player('{{ $video->preview }}')"
    x-ref="container"
    class="absolute z-20 inset-y-0 inset-x-0 bg-black/25 sm:inset-x-10 sm:bg-black"
>
    <img
        alt="{{ $video->title }}"
        srcset="{{ $video->placeholder }}"
        src="{{ $video->thumbnail }}"
        class="h-full w-full object-contain"
        crossorigin="use-credentials"
        loading="lazy"
    />

    <video
        x-cloak
        x-show="$store.previews.on"
        x-ref="video"
        x-intersect:enter="play"
        x-intersect:leave="stop"
        x-on:click="toggle"
        playsinline
        muted
        autoplay
        class="h-full w-full absolute inset-0 z-40"
    />
</div>
