<article
    x-data="{ shown: false }"
    x-intersect.once="shown = true"
    class="h-24 max-h-[6rem] min-h-[6rem] w-full">
    <div class="flex flex-row flex-nowrap items-center gap-x-4" x-show="shown" x-transition>
        <div class="h-20 w-36 bg-black object-cover text-transparent">
            <div
                x-data="{ preview: false }"
                @mouseover="preview = true"
                @mouseleave="preview = false"
                @touchstart.passive="preview = true"
                @touchmove.passive="preview = true"
                @touchend.passive="preview = false"
                class="relative h-full w-full">
                <a href="{{ route('videos.view', $item) }}">
                    <img
                        alt="{{ $item->title }}"
                        src="{{ $item->thumbnail }}"
                        srcset="{{ $item->placeholder }}"
                        class="relative h-full w-full bg-black object-fill text-transparent"
                        crossorigin="use-credentials"
                        loading="lazy" />

                    <template x-if="preview">
                        <x-videos::player
                            x-cloak
                            x-show="preview"
                            :$item
                            :manifest="$item->preview"
                            :controls="false"
                            :rate="1.05"
                            class="absolute inset-0 z-10 h-full w-full object-fill"
                            autoplay
                            muted
                            loop />
                    </template>
                </a>
            </div>
        </div>

        <div class="grow">
            <div class="flex flex-col">
                <a href="{{ route('videos.view', $item) }}">
                    <h2 class="line-clamp-1 text-sm font-semibold capitalize tracking-tight">
                        {{ $item->title }}
                    </h2>

                    <dl>
                        <dt class="sr-only">Duration</dt>
                        <dd class="text-ellipsis text-xs font-medium text-gray-400">
                            <time>
                                {{ duration($item->duration) }}
                            </time>
                        </dd>

                        @if ($item->episode || $item->season)
                            <dt class="sr-only">Identifier</dt>
                            <dd class="text-xs font-medium text-gray-400">
                                {{ $item->identifier }}
                            </dd>
                        @endif

                        @if ($item->caption)
                            <dt class="sr-only">Captions</dt>
                            <dd class="text-xs font-medium text-gray-400">
                                {{ __('CC') }}
                            </dd>
                        @endif
                    </dl>
                </a>

                @if ($item->tags->isNotEmpty())
                    <x-videos::tags class="line-clamp-1 text-xs" :items="$item->tags" />
                @endif
            </div>
        </div>
    </div>
</article>
