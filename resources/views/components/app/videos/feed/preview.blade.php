@props([
    'video',
])

<div
    x-data="player('{{ $video->preview }}')"
    x-ref="container"
    class="absolute z-20 inset-y-0 inset-x-0 bg-black/25 sm:inset-x-10 sm:bg-black"
    x-on:click="toggle"
>
    <img
        alt="{{ $video->title }}"
        srcset="{{ $video->placeholder }}"
        src="{{ $video->thumbnail }}"
        class="h-full w-full brightness-75 object-contain"
        crossorigin="use-credentials"
        loading="lazy"
    />

    <video
        x-cloak
        x-ref="video"
        x-intersect:leave="stop"
        x-show="open"
        playsinline
        muted
        class="h-full w-full absolute inset-0 z-40"
    />
</div>
