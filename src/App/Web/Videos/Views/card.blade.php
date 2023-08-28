<article class="flex flex-col space-y-1.5 py-8">
    <dl>
        <dt class="sr-only">Published on</dt>
        <dd class="text-base font-medium leading-4 text-gray-400">
            <time datetime="{{ $item->created_at->format('Y-m-d\TH:i:s.uP') }}">
                {{ $item->created_at->format('F d, Y') }}
            </time>

            <span> - </span>

            <time datetime="{{ duration($item->duration) }}">
                {{ duration($item->duration) }}
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
            @touchstart.passive="preview = true"
            @touchend.passive="preview = false"
            @touchcancel.passive="preview = false"
            class="relative h-64 max-h-[16rem] min-h-[16rem] w-full">
            <a href="{{ route('videos.view', $item) }}">
                <img
                    alt="{{ $item->name }}"
                    src="{{ $item->thumbnail }}"
                    srcset="{{ $item->placeholder }}"
                    class="h-full w-full bg-black object-cover text-transparent"
                    crossorigin="use-credentials"
                    loading="lazy" />

                <template x-if="preview">
                    <x-videos::player
                        x-cloak
                        x-show="preview"
                        :model="$item"
                        :manifest="$item->preview"
                        :controls="false"
                        class="absolute inset-0 h-full w-full bg-black object-cover"
                        autoplay
                        muted
                        loop />
                </template>
            </a>
        </div>
    </div>
</article>
