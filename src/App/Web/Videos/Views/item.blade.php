<article class="rounded bg-gray-700/40 p-4 shadow-md">
    <div class="flex flex-row flex-nowrap items-center space-x-4">
        <a class="flex-none" href="{{ route('videos.view', $item) }}">
            <img
                alt="{{ $item->title }}"
                src="{{ $item->thumbnail }}"
                class="h-20 w-28 bg-black object-cover text-transparent"
                crossorigin="use-credentials"
                loading="lazy" />
        </a>

        <div class="grow">
            <div class="flex flex-col">
                <a href="{{ route('videos.view', $item) }}">
                    <h2 class="line-clamp-1 text-sm font-semibold capitalize tracking-tight">
                        {{ $item->title }}
                    </h2>

                    <dl>
                        <dt class="sr-only">Duration</dt>
                        <dd class="text-ellipsis text-xs font-medium text-gray-400">
                            <time>
                                {{ duration($item->duration) }}
                            </time>
                        </dd>

                        @if ($item->episode || $item->season)
                            <dt class="sr-only">Identifier</dt>
                            <dd class="text-xs font-medium text-gray-400">
                                {{ implode('', [$item->season, $item->episode]) }}
                            </dd>
                        @endif
                    </dl>
                </a>

                @if ($item->tags->isNotEmpty())
                    <x-videos::tags class="text-xs" :items="$item->tags" />
                @endif
            </div>
        </div>
    </div>
</article>
