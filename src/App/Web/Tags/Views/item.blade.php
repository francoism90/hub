<article class="rounded bg-gray-700/40 p-4 shadow-md">
    <div class="flex flex-row flex-nowrap items-center space-x-4">
        <div class="h-16 w-16 flex items-center justify-center rounded bg-gray-600 py-1 px-2 text-xs text-gray-200">
            <a href="{{ route('videos.index', ['tag' => $item->getRouteKey()]) }}">
                <x-heroicon-o-hashtag class="h-4 w-4" />
            </a>
        </div>

        <div class="grow">
            <div class="flex flex-col space-y-1.5">
                <dl>
                    <dt class="sr-only">Published on</dt>
                    <dd class="hidden sm:block text-sm font-medium leading-4 text-gray-400 text-ellipsis">
                        <time datetime="{{ $item->created_at->format('Y-m-d\TH:i:s.uP') }}">
                            {{ $item->created_at->format('F d, Y') }}
                        </time>
                    </dd>
                </dl>

                <h2 class="capitalize text-sm font-bold leading-6 tracking-tight line-clamp-2">
                    <a href="{{ route('videos.index', ['tag' => $item->getRouteKey()]) }}">
                        {{ $item->name }}
                    </a>
                </h2>
            </div>
        </div>
    </div>
</article>
