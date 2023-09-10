<article class="rounded bg-gray-700/40 p-4 shadow-md">
    <a
        href="{{ route('videos.index', ['tag' => $item->getRouteKey()]) }}">
        <div class="flex flex-row flex-nowrap items-center space-x-4">
            <div class="flex h-16 w-16 items-center justify-center rounded bg-gray-600 px-2 py-1 text-xs text-gray-200">
                <x-dynamic-component :component="$icon" class="h-5 w-5" />
            </div>

            <div class="grow">
                <div class="flex flex-col space-y-1.5">
                    <h2 class="line-clamp-1 text-sm font-bold capitalize leading-6 tracking-tight">
                        {{ $item->name }}
                    </h2>

                    @if (filled($type))
                        <dl>
                            <dt class="sr-only">{{ __('Type') }}</dt>
                            <dd class="text-ellipsis text-sm font-medium leading-4 text-gray-400">
                                {{ $type }}
                            </dd>
                        </dl>
                    @endif
                </div>
            </div>
        </div>
    </a>
</article>
