<article
    wire:key="{{ $item->getRouteKey() }}"
    x-data="{ preview: false }"
    {{ $attributes->class('flex flex-col gap-y-1.5 py-8') }}>
    <dl class="inline-flex">
        <dt class="sr-only">{{ __('Published on') }}</dt>
        <dd class="text-base font-medium leading-4 text-gray-400">
            <time datetime="{{ $item->published_at->format('Y-m-d\TH:i:s.uP') }}">
                {{ $item->published_at->format('F d, Y') }}
            </time>
        </dd>

        @if ($item->episode || $item->season)
            <dt class="sr-only">{{ __('ID') }}</dt>
            <dd class="text-base font-medium leading-4 text-gray-400">
                {{ $item->identifier }}
            </dd>
        @endif
    </dl>

    <h2 class="line-clamp-2 text-2xl font-bold capitalize leading-8 tracking-tight">
        <a
            href="{{ route('videos.view', $item) }}"
            aria-label="{{ $item->title }}"
            title="{{ $item->title }}">
            {{ $item->title }}
        </a>
    </h2>

    @if ($item->tags->isNotEmpty())
        <x-videos::tags :items="$item->tags" />
    @endif

    <div class="h-60 max-h-[14rem] min-h-[14rem] py-2 sm:h-64 sm:max-h-[16rem] sm:min-h-[16rem]">
        <div
            x-on:mouseover="preview = true"
            x-on:mouseleave="preview = false"
            x-on:touchstart.passive="preview = true"
            x-on:touchmove.passive="preview = true"
            x-on:touchend.passive="preview = false"
            class="relative aspect-video h-full w-full flex-shrink-0">
            <a href="{{ route('videos.view', $item) }}">
                <img
                    alt="{{ $item->title }}"
                    src="{{ $item->thumbnail }}"
                    srcset="{{ $item->placeholder }}"
                    class="absolute inset-0 z-0 h-full w-full bg-black object-fill"
                    crossorigin="use-credentials"
                    loading="lazy" />

                <div class="absolute inset-0 z-20 h-full w-full">
                    <div class="absolute bottom-2 right-2 flex items-center gap-x-1.5 bg-black/30 px-1 py-0.5 text-xs font-medium text-gray-300">
                        @if ($item->caption)
                            <span>{{ __('CC') }}</span>
                        @endif

                        <span>{{ duration($item->duration) }}</span>
                    </div>
                </div>

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
    </div>
</article>
