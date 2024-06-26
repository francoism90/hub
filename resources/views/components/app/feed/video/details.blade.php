@props(['video'])

<div class="absolute inset-x-4 bottom-4 z-30">
    <h1 class="line-clamp-2 flex h-24 items-end pr-4 text-sm font-semibold tracking-tight">
        {{ $video->title }}
    </h1>

    <dl class="dl text-xs font-medium text-secondary-400">
        <dt class="sr-only">{{ __('Time') }}</dt>
        <dd class="text-ellipsis">
            <time> {{ duration($video->duration) }} </time>
        </dd>

        @if ($video->episode || $video->season)
            <dt class="sr-only">{{ __('ID') }}</dt>
            <dd class="text-ellipsis">{{ $video->identifier }}</dd>
        @endif

        @if ($video->caption)
            <dt class="sr-only">{{ __('Captions') }}</dt>
            <dd class="text-ellipsis">{{ __('CC') }}</dd>
        @endif

        <dt class="sr-only">{{ __('Published on') }}</dt>
        <dd class="text-ellipsis">
            <time datetime="{{ $video->published->jsonSerialize() }}">
                {{ $video->published->format('M d, Y') }}
            </time>
        </dd>
    </dl>

    @if ($video->tags()->count())
    <div class="line-clamp-1 flex flex-wrap gap-x-2 gap-y-1">
        @foreach ($video->tags as $tag)
        <a
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
