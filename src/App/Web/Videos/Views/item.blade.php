<article class="rounded bg-gray-700/40 p-4 shadow-md">
    <div class="flex flex-row flex-nowrap items-center space-x-4">
        <a href="{{ route('videos.view', $item) }}">
            <div class="h-16 w-16 flex-none">
                <img
                    alt="{{ $item->name }}"
                    src="{{ $item->thumbnail }}"
                    class="h-full w-full bg-black object-cover text-transparent"
                    crossorigin="use-credentials"
                    loading="lazy" />
            </div>
        </a>

        <div class="grow">
            <div class="s flex flex-col">
                <a href="{{ route('videos.view', $item) }}">

                    <h2 class="line-clamp-1 text-sm font-semibold capitalize tracking-tight">
                        {{ $item->name }}
                    </h2>

                    <dl>
                        <dt class="sr-only">Duration</dt>
                        <dd class="text-ellipsis text-xs font-medium text-gray-400">
                            <time>
                                {{ duration($item->duration) }}
                            </time>
                        </dd>
                    </dl>
                </a>

                @if ($item->tags->isNotEmpty())
                    <x-videos::tags class="text-xs" :items="$item->tags" />
                @endif
            </div>
        </div>
    </div>
</article>
