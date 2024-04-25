@aware([
    'item',
])

<div
    x-data="player('{{ $item->preview }}')"
    x-ref="container"
>
    <a
        x-on:mouseover="start"
        x-on:mouseleave="stop"
        x-on:touchstart.passive="start"
        x-on:touchmove.passive="start"
        x-on:touchend.passive="stop"
        href="{{ route('videos.view', $item) }}"
        class="relative block h-44 max-h-44 w-full bg-black"
    >
        <img
            alt="{{ $item->title }}"
            srcset="{{ $item->placeholder }}"
            src="{{ $item->thumbnail }}"
            class="h-44 max-h-44 w-full rounded object-fill"
            crossorigin="use-credentials"
            loading="lazy"
        />

        <video
            x-cloak
            x-ref="video"
            x-show="open"
            class="absolute inset-0 z-10 h-44 max-h-44 w-full rounded object-fill"
            playsinline
            autoplay
            muted
        />
    </a>
</div>
