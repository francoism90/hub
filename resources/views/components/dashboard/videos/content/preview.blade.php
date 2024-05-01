@aware([
    'item',
])

<div
    x-data
    x-on:mouseover="loadManifest($refs.video, '{{ $item->preview }}')"
    x-on:mouseleave="destroy"
    x-on:touchstart.passive="loadManifest($refs.video, '{{ $item->preview }}')"
    x-on:touchmove.passive="loadManifest($refs.video, '{{ $item->preview }}')"
    x-on:touchend.passive="destroy"
>
    <a
        wire:navigate
        href="{{ route('videos.view', $item) }}"
        class="block"
    >

        <div class="relative h-44 max-h-44">
            <img
                alt="{{ $item->title }}"
                srcset="{{ $item->placeholder }}"
                src="{{ $item->thumbnail }}"
                class="h-full w-full rounded-xs object-fill"
                crossorigin="use-credentials"
                loading="lazy"
            />

            <video
                x-cloak
                x-ref="video"
                x-show="show"
                x-transition
                class="absolute inset-0 z-40 h-full w-full rounded-xs object-fill"
                playsinline
                muted
                autoplay
                loop
            >
                <source />
            </video>
        </div>
    </a>
</div>
