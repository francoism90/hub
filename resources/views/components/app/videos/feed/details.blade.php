@aware([
    'item',
])

<div class="absolute bottom-4 inset-x-4 sm:inset-x-16 z-30">
    <h1 class="font-medium text-sm leading-none tracking-tight line-clamp-1">
        {{ $item->title }}
    </h1>

    <dl class="inline-flex items-center text-xs text-secondary-400">
        <dt class="sr-only">{{ __('Time') }}</dt>
        <dd class="text-ellipsis">
            <time>
                {{ duration($item->duration) }}
            </time>
        </dd>

        @if ($item->episode || $item->season)
            <dt class="sr-only">{{ __('ID') }}</dt>
            <dd class="text-ellipsis">
                {{ $item->identifier }}
            </dd>
        @endif

        @if ($item->caption)
            <dt class="sr-only">{{ __('Captions') }}</dt>
            <dd class="text-ellipsis">
                {{ __('CC') }}
            </dd>
        @endif

        <dt class="sr-only">{{ __('Published on') }}</dt>
        <dd class="text-ellipsis">
            <time datetime="{{ $item->published->jsonSerialize() }}">
                {{ $item->published->format('M d, Y') }}
            </time>
        </dd>
    </dl>

    @if ($item->tags()->count())
        <div class="flex flex-wrap gap-2 line-clamp-1">
            @foreach ($item->tags as $tag)
                <a
                    wire:key="tag-{{ $tag->getRouteKey() }}"
                    class="text-xs font-medium uppercase tracking-tight text-primary-500 hover:text-primary-400"
                    href="{{ route('tags.view', $tag) }}"
                    aria-label="{{ $tag->name }}"
                >
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    @endif
</div>
