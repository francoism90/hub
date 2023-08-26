<article class="rounded bg-gray-700/40 p-4 shadow-md">
    <div class="flex flex-row flex-nowrap items-center space-x-4">
        <div class="flex h-16 w-16 items-center justify-center rounded bg-gray-600 px-2 py-1 text-xs text-gray-200">
            <a href="{{ route('videos.index', ['tag' => $item->getRouteKey()]) }}">
                <x-dynamic-component :component="$icon" class="h-5 w-5" />
            </a>
        </div>

        <div class="grow">
            <div class="flex flex-col space-y-1.5">
                <dl>
                    <dt class="sr-only">Published on</dt>
                    <dd class="hidden text-ellipsis text-sm font-medium leading-4 text-gray-400 sm:block">
                        <time datetime="{{ $item->created_at->format('Y-m-d\TH:i:s.uP') }}">
                            {{ $item->created_at->format('F d, Y') }}
                        </time>
                    </dd>
                </dl>

                <h2 class="line-clamp-2 text-sm font-bold capitalize leading-6 tracking-tight">
                    <a href="{{ route('videos.index', ['tag' => $item->getRouteKey()]) }}">
                        {{ $item->name }}
                    </a>
                </h2>
            </div>
        </div>
    </div>
</article>
