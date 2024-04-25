@props([
    'item',
])

<article
    wire:key="item-{{ $item->getRouteKey() }}"
    class="flex flex-col flex-nowrap h-72 max-h-72 w-full gap-x-4"
>
    <x-dashboard.videos.content.preview />

    <div class="flex flex-col p-3">
            <a href="{{ route('videos.view', $item) }}">
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
            </a>

            @if ($item->tags->isNotEmpty())
                <x-app::videos-tags
                    class="line-clamp-1 text-xs"
                    :items="$item->tags"
                />
            @endif
        </div>
</article>
