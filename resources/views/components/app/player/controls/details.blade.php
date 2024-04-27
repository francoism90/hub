@aware([
    'video',
    'panel'
])

<div class="absolute z-20 bottom-24 left-0">
    <div class="flex flex-col flex-nowrap gap-1.5">
        <h1 class="h-24 inline-flex items-end text-2xl font-semibold leading-none tracking-tight line-clamp-1 sm:text-3xl">
            {{ $video->title }}
        </h1>

        <dl class="dl text-sm font-medium text-secondary-300">
            <dt class="sr-only">{{ __('Time') }}</dt>
            <dd class="text-ellipsis">
                <time>
                    {{ duration($video->duration) }}
                </time>
            </dd>

            <dt class="sr-only">{{ __('Published on') }}</dt>
            <dd class="text-ellipsis">
                <time datetime="{{ $video->published->jsonSerialize() }}">
                    {{ $video->published->format('M d, Y') }}
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
        </dl>

        @if ($video->tags()->count())
            <div class="flex flex-wrap gap-2 line-clamp-1">
                @foreach ($video->tags as $tag)
                    <a
                        wire:key="tag-{{ $tag->getRouteKey() }}"
                        class="text-sm font-medium uppercase tracking-tight text-primary-500 hover:text-primary-400"
                        {{-- href="{{ route('tags.view', $tag) }}" --}}
                        aria-label="{{ $tag->name }}"
                    >
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
