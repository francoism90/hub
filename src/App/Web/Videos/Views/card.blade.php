<article class="flex flex-col space-y-1.5 py-8">
    <dl>
        <dt class="sr-only">Published on</dt>
        <dd class="text-base font-medium leading-4 text-gray-400">
            <time datetime="{{ $item->created_at->format('Y-m-d\TH:i:s.uP') }}">
                {{ $item->created_at->format('F d, Y') }}
            </time>
        </dd>
    </dl>

    <h2 class="line-clamp-2 text-2xl font-bold capitalize leading-8 tracking-tight">
        <a href="{{ route('videos.view', $item) }}">
            {{ $item->name }}
        </a>
    </h2>

    @if ($item->tags)
        <x-videos::tags :items="$item->tags" />
    @endif

    <div class="py-2">
        <div
            x-data="{ preview: false }"
            @mouseover="preview = true"
            @mouseleave="preview = false"
            class="relative h-64 max-h-[15rem] min-h-[15rem] w-full">
            <a href="{{ route('videos.view', $item) }}">
                <img
                    alt="{{ $item->name }}"
                    src="{{ $item->thumbnail }}"
                    class="h-full w-full bg-black object-cover text-transparent"
                    crossorigin="use-credentials"
                    loading="lazy" />

                <x-videos::player
                    x-cloak
                    x-show="preview"
                    @mouseover="preview = true"
                    @mouseleave="preview = false"
                    :model="$item"
                    :manifest="$item->preview"
                    :controls="false"
                    class="absolute inset-0 h-full w-full bg-black object-cover"
                    autoplay
                    muted
                    loop />
            </a>
        </div>
    </div>
</article>
