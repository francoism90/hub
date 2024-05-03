@props([
    'item',
])

<article
    wire:key="feed-{{ $item->getRouteKey() }}"
    class="flex h-72 max-h-72 w-full flex-col flex-nowrap"
>
    <x-dashboard.videos.content.preview />

    <a class="block" href="{{ route('videos.view', $item) }}">
        <h1 class="line-clamp-1 pt-4 text-sm font-medium leading-none tracking-tight">
            {{ $item->title }}
        </h1>

        <dl class="dl text-xs text-secondary-400">
            <dt class="sr-only">{{ __('Time') }}</dt>
            <dd class="text-ellipsis">
                <time> {{ duration($item->duration) }} </time>
            </dd>

            @if ($item->episode || $item->season)
            <dt class="sr-only">{{ __('ID') }}</dt>
            <dd class="text-ellipsis">{{ $item->identifier }}</dd>
            @endif

            @if ($item->caption)
            <dt class="sr-only">{{ __('Captions') }}</dt>
            <dd class="text-ellipsis">{{ __('CC') }}</dd>
            @endif

            <dt class="sr-only">{{ __('Published on') }}</dt>
            <dd class="text-ellipsis">
                <time datetime="{{ $item->published->jsonSerialize() }}">
                    {{ $item->published->format('M d, Y') }}
                </time>
            </dd>
        </dl>
    </a>

    @if ($item->tags()->count())
    <div class="line-clamp-1 flex flex-wrap gap-2">
        @foreach ($item->tags as $tag)
        <a
            wire:click="$set('form.query', '{{ $tag->name }}')"
            class="text-xs font-medium uppercase tracking-tight text-primary-500 hover:text-primary-400"
            aria-label="{{ $tag->name }}"
        >
            {{ $tag->name }}
        </a>
        @endforeach
    </div>
    @endif
</article>
