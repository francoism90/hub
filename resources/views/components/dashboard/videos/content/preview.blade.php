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
        class="relative block h-40 w-full border-b border-secondary-700/30 bg-black"
    >
        <img
            alt="{{ $item->title }}"
            srcset="{{ $item->placeholder }}"
            src="{{ $item->thumbnail }}"
            class="h-40 w-full rounded-t object-fill"
            crossorigin="use-credentials"
            loading="lazy"
        />

        <video
            x-cloak
            x-ref="video"
            x-show="open"
            class="absolute inset-0 z-10 h-40 max-h-40 w-full rounded-t object-fill"
            playsinline
            autoplay
            muted
        />
    </a>
</div>
