<article
    x-data="{ show: false }"
    x-intersect:enter="show = true"
    x-intersect:leave="show = false"
    class="relative h-dvh min-h-dvh w-dvw snap-center"
>
    <template x-if="show">
        <div>
            <x-app.feed.video.settings :$settings />

            <img
                alt="{{ $video->title }}"
                crossorigin="use-credentials"
                loading="lazy"
                srcset="{{ $video->placeholder }}"
                src="{{ $video->thumbnail }}"
                class="absolute z-0 inset-0 h-full w-full object-fill blur-3xl brightness-50 saturate-50"
            />

            <div class="absolute z-10 inset-0 h-full w-full mx-auto bg-black sm:w-3/5 xl:max-w-2xl">
                <div class="relative h-[calc(100vh-4rem)] w-full">
                    <x-app.feed.video.preview :$video />
                    <x-app.feed.video.details :$video />
                    <x-app.feed.video.actions :$actions />
                </div>
            </div>
        </div>
    </template>
</article>

