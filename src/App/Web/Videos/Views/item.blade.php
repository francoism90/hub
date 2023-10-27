<article
    wire:key="{{ $item->getRouteKey() }}"
    x-data="{ shown: false, preview: false }"
    x-intersect.once="shown = true"
    class="h-20 max-h-[5rem] min-h-[5rem] w-full">
    <div class="flex flex-row flex-nowrap items-center gap-x-4" x-show="shown" x-transition>
        <div
            x-on:mouseover="preview = true"
            x-on:mouseleave="preview = false"
            x-on:touchstart.passive="preview = true"
            x-on:touchmove.passive="preview = true"
            x-on:touchend.passive="preview = false"
            class="relative aspect-video h-20 w-40 flex-shrink-0">
            <a href="{{ route('videos.view', $item) }}">
                <img
                    alt="{{ $item->title }}"
                    src="{{ $item->thumbnail }}"
                    srcset="{{ $item->placeholder }}"
                    class="h-full w-full bg-black object-fill"
                    crossorigin="use-credentials"
                    loading="lazy" />

                <template x-if="preview">
                    <x-videos::player
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

        <div class="flex grow flex-col">
            <a href="{{ route('videos.view', $item) }}">
                <h2
                    class="line-clamp-1 text-sm font-semibold capitalize tracking-tight"
                    aria-label="{{ $item->title }}"
                    title="{{ $item->title }}">
                    {{ $item->title }}
                </h2>

                <dl>
                    <dt class="sr-only">{{ __('Time') }}</dt>
                    <dd class="text-ellipsis text-xs font-medium text-gray-400">
                        <time>
                            {{ duration($item->duration) }}
                        </time>
                    </dd>

                    @if ($item->episode || $item->season)
                        <dt class="sr-only">{{ __('ID') }}</dt>
                        <dd class="text-xs font-medium text-gray-400">
                            {{ $item->identifier }}
                        </dd>
                    @endif

                    @if ($item->caption)
                        <dt class="sr-only">{{ __('CC') }}</dt>
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
</article>
