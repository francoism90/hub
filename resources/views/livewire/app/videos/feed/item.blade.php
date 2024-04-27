<article class="relative w-full h-full snap-center bg-black">
    <img
        alt="{{ $video->title }}"
        srcset="{{ $video->placeholder }}"
        src="{{ $video->thumbnail }}"
        class="absolute inset-0 object-fill blur-3xl brightness-50 saturate-50"
        crossorigin="use-credentials"
        loading="lazy"
    />

    <x-app.feed.navigation :$navigation />
    <x-app.feed.item :$video :$controls />
</article>
