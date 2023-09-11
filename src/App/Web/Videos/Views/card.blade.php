<article id="video-{{ $item->getRouteKey() }}" {{ $attributes->class('flex flex-col space-y-1.5 py-8') }}>
    <dl class="inline-flex">
        <dt class="sr-only">Published on</dt>
        <dd class="text-base font-medium leading-4 text-gray-400">
            <time datetime="{{ $item->published_at->format('Y-m-d\TH:i:s.uP') }}">
                {{ $item->published_at->format('F d, Y') }}
            </time>
        </dd>

        @if ($item->episode || $item->season)
            <dt class="sr-only">Identifier</dt>
            <dd class="text-base font-medium leading-4 text-gray-400">
                {{ implode('', [$item->season, $item->episode]) }}
            </dd>
        @endif
    </dl>

    <h2 class="line-clamp-2 text-2xl font-bold capitalize leading-8 tracking-tight">
        <a href="{{ route('videos.view', $item) }}">
            {{ $item->title }}
        </a>
    </h2>

    @if ($item->tags->isNotEmpty())
        <x-videos::tags :items="$item->tags" />
    @endif

    <div class="h-60 max-h-[14rem] min-h-[14rem] py-2 sm:h-64 sm:max-h-[16rem] sm:min-h-[16rem]">
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
                    class="absolute inset-0 z-0 h-full w-full bg-black object-fill text-transparent"
                    crossorigin="use-credentials"
                    loading="lazy" />

                <div class="absolute inset-0 z-20 h-full w-full">
                    <div class="absolute bottom-2 right-2 flex items-center gap-x-1.5 bg-black/30 px-1 py-0.5 text-xs text-gray-300">
                        @if ($item->caption)
                            <span>{{ __('CC') }}</span>
                        @endif

                        <span>{{ duration($item->duration) }}</span>
                    </div>
                </div>

                <template x-if="preview">
                    <x-videos::player
                        x-cloak
                        x-show="preview"
                        :video="$item"
                        :manifest="$item->preview"
                        :controls="false"
                        class="absolute inset-0 z-10 h-full w-full object-fill"
                        autoplay
                        muted
                        loop />
                </template>
            </a>
        </div>
    </div>
</article>
