@props([
    'video',
])

<a
    wire:navigate
    href="{{ route('videos.view', $video) }}"
>
    <div

        class="absolute z-10 inset-y-0 inset-x-0 bg-black/25 sm:inset-x-10 sm:bg-black"
    >
        <img
            alt="{{ $video->title }}"
            srcset="{{ $video->placeholder }}"
            src="{{ $video->thumbnail }}"
            class="h-full w-full brightness-90 object-contain"
            crossorigin="use-credentials"
            loading="lazy"
        />

        <video
            x-cloak
            x-ref="video"
            x-show="$wire.$parent.preview"
            x-transition
            x-intersect:enter.full="loadManifest($refs.video, '{{ $video->preview }}')"
            x-intersect:leave="destroy"
            class="h-full w-full absolute z-30 inset-0 brightness-90"
            playsinline
            muted
            autoplay
            loop
        >
            <source />
        </video>
    </div>
</a>
