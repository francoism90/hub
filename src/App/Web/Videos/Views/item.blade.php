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
            <div class="flex flex-col space-y-1.5">
                <a href="{{ route('videos.view', $item) }}">
                    <dl>
                        <dt class="sr-only">Published on</dt>
                        <dd class="text-ellipsis text-sm font-medium leading-4 text-gray-400">
                            <time datetime="{{ $item->created_at->format('Y-m-d\TH:i:s.uP') }}">
                                {{ $item->created_at->format('F d, Y') }}
                            </time>
                        </dd>
                    </dl>

                    <h2 class="line-clamp-1 text-sm font-bold capitalize leading-6 tracking-tight">
                        {{ $item->name }}
                    </h2>
                </a>

                @if ($item->tags->isNotEmpty())
                    <x-videos::tags :items="$item->tags" />
                @endif
            </div>
        </div>
    </div>
</article>
