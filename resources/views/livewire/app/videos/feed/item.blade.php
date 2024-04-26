<article
    wire:key="{{ $video->getRouteKey() }}"
    class="relative w-full h-full snap-center bg-black"
>
    <img
        alt="{{ $video->title }}"
        srcset="{{ $video->placeholder }}"
        src="{{ $video->thumbnail }}"
        class="absolute inset-0 object-fill blur-3xl brightness-50 saturate-50"
        crossorigin="use-credentials"
        loading="lazy"
    />

    <div class="absolute z-10 mx-auto inset-0 w-full sm:w-3/5 xl:max-w-2xl">
        <x-app.videos.feed.preview :$video />
        <x-app.videos.feed.details :$video />
        <x-app.videos.feed.controls :$controls />
    </div>
</article>
