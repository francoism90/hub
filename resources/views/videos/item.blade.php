<article
    wire:key="{{ $item->getRouteKey() }}"
    x-data="{ preview: false }"
>
    <div class="flex flex-col flex-nowrap gap-x-4 rounded border border-gray-700/30 bg-gray-900/75">
        <div
            x-on:mouseover="preview = true"
            x-on:mouseleave="preview = false"
            x-on:touchstart.passive="preview = true"
            x-on:touchmove.passive="preview = true"
            x-on:touchend.passive="preview = false"
            class="relative h-44 max-h-44 w-full border-b border-gray-700/30 bg-black"
        >
            <x-ui-link href="{{ route('videos.view', $item) }}">
                <img
                    alt="{{ $item->title }}"
                    src="{{ $item->thumbnail }}"
                    srcset="{{ $item->placeholder }}"
                    class="h-full w-full rounded-t object-fill"
                    crossorigin="use-credentials"
                    loading="lazy"
                />

                <template x-if="preview">
                    <x-videos-player
                        :$item
                        :manifest="$item->preview"
                        :controls="false"
                        :rate="1.05"
                        class="absolute inset-0 z-10 h-full w-full rounded-t object-fill"
                        autoplay
                        muted
                        loop
                    />
                </template>
            </x-ui-link>
        </div>

        <div class="flex flex-col p-3.5">
            <x-ui-link href="{{ route('videos.view', $item) }}">
                <h2
                    class="line-clamp-1 text-sm font-medium capitalize tracking-tight"
                    aria-label="{{ $item->title }}"
                    title="{{ $item->title }}"
                >
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
                        <dt class="sr-only">{{ __('Captions') }}</dt>
                        <dd class="text-xs font-medium text-gray-400">
                            {{ __('CC') }}
                        </dd>
                    @endif

                    <dt class="sr-only">{{ __('Published on') }}</dt>
                    <dd class="text-ellipsis text-xs font-medium text-gray-400">
                        <time datetime="{{ $item->published->format('Y-m-d\TH:i:s.uP') }}">
                            {{ $item->published->format('M d, Y') }}
                        </time>
                    </dd>
                </dl>
            </x-ui-link>

            @if ($item->tags->isNotEmpty())
                <x-videos-tags
                    class="line-clamp-1 text-xs"
                    :items="$item->tags"
                />
            @endif
        </div>
    </div>
</article>
