@props([
    'video',
])

<div class="absolute z-30 bottom-4 inset-x-4 sm:inset-x-16">
    <h1 class="font-medium text-sm leading-none tracking-tight line-clamp-1">
        {{ $video->title }}
    </h1>

    <dl class="inline-flex videos-center text-xs text-secondary-400">
        <dt class="sr-only">{{ __('Time') }}</dt>
        <dd class="text-ellipsis">
            <time>
                {{ duration($video->duration) }}
            </time>
        </dd>

        @if ($video->episode || $video->season)
            <dt class="sr-only">{{ __('ID') }}</dt>
            <dd class="text-ellipsis">
                {{ $video->identifier }}
            </dd>
        @endif

        @if ($video->caption)
            <dt class="sr-only">{{ __('Captions') }}</dt>
            <dd class="text-ellipsis">
                {{ __('CC') }}
            </dd>
        @endif

        <dt class="sr-only">{{ __('Published on') }}</dt>
        <dd class="sr-only text-ellipsis">
            <time datetime="{{ $video->published->jsonSerialize() }}">
                {{ $video->published->format('M d, Y') }}
            </time>
        </dd>
    </dl>

    @if ($video->tags()->count())
        <div class="flex flex-wrap gap-2 line-clamp-1">
            @foreach ($video->tags as $tag)
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