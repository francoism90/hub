@aware([
    'item',
])

<a
    x-data="{ show: false }"
    x-intersect:once="show = true"
    wire:navigate
    href="{{ route('videos.view', $item) }}"
    class="block h-44"
>
    <template x-if="show">
        <div
            x-on:mouseover="loadManifest($refs.video, '{{ $item->preview }}')"
            x-on:mouseleave="destroy"
            x-on:touchstart.passive="loadManifest($refs.video, '{{ $item->preview }}')"
            x-on:touchmove.passive="loadManifest($refs.video, '{{ $item->preview }}')"
            x-on:touchend.passive="destroy"
            class="relative h-full max-h-44"
        >
            <img
                alt="{{ $item->title }}"
                crossorigin="use-credentials"
                loading="lazy"
                srcset="{{ $item->placeholder }}"
                src="{{ $item->thumbnail }}"
                class="h-full w-full rounded-xs object-fill"
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
    </template>
</a>
