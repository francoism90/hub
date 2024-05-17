@aware([
    'video',
    'panel'
])

<div class="absolute inset-x-0 bottom-24 z-20">
    <div class="flex flex-col flex-nowrap gap-y-1.5">
        <h1 class="line-clamp-1 flex h-24 items-end text-2xl font-semibold leading-none tracking-tight sm:text-3xl">
            {{ $video->title }}
        </h1>

        <dl class="dl text-sm font-medium text-secondary-300">
            <dt class="sr-only">{{ __('Time') }}</dt>
            <dd class="text-ellipsis">
                <time> {{ duration($video->duration) }} </time>
            </dd>

            <dt class="sr-only">{{ __('Published on') }}</dt>
            <dd class="text-ellipsis">
                <time datetime="{{ $video->published->jsonSerialize() }}">
                    {{ $video->published->format('M d, Y') }}
                </time>
            </dd>

            @if ($video->episode || $video->season)
                <dt class="sr-only">{{ __('ID') }}</dt>
                <dd class="text-ellipsis">{{ $video->identifier }}</dd>
            @endif

            @if ($video->caption)
                <dt class="sr-only">{{ __('Captions') }}</dt>
                <dd class="text-ellipsis">{{ __('CC') }}</dd>
            @endif
        </dl>

        @if ($video->tags()->count())
        <div class="line-clamp-1 flex flex-wrap gap-x-2 gap-y-1">
            @foreach ($video->tags as $tag)
            <a
                class="text-sm font-medium uppercase tracking-tight text-primary-500 hover:text-primary-400"
                href="{{ route('tags.view', $tag) }}"
                aria-label="{{ $tag->name }}"
            >
                {{ $tag->name }}
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>
