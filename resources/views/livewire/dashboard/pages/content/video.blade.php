<x-wireuse::layout-container class="flex flex-col gap-y-3" fluid>
    <div class="border-b border-secondary-400/40 p-3">
        <h1 class="text-base font-medium leading-none tracking-tight line-clamp-1">
            {{ $video->title }}
        </h1>

        <dl class="dl text-xs font-medium text-secondary-300">
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
        </dl>
    </div>

    <x-dashboard.ui.tabs :$actions />
</x-wireuse::layout-container>
