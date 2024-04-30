<article class="relative h-full w-full snap-center">
    <img
        alt="{{ $video->title }}"
        srcset="{{ $video->placeholder }}"
        src="{{ $video->thumbnail }}"
        class="absolute z-0 inset-0 h-full w-full object-fill blur-3xl brightness-50 saturate-50"
        crossorigin="use-credentials"
        loading="lazy"
    />

    <x-app.feed.video.settings :nodes="$settings" />

    <div class="absolute z-20 mx-auto inset-0 h-[calc(100vh-4rem)] w-full sm:w-3/5 xl:max-w-2xl">
        <x-app.feed.video.preview :$video />
        <x-app.feed.video.details :$video />
        <x-app.feed.video.actions :nodes="$controls" />
    </div>
</article>
