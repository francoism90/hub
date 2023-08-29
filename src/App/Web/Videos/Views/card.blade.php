<article id="video-{{ $item->id }}" class="flex flex-col space-y-1.5 py-8">
    <dl class="inline-flex">
        <dt class="sr-only">Published on</dt>
        <dd class="text-base font-medium leading-4 text-gray-400">
            <time datetime="{{ $item->created_at->format('Y-m-d\TH:i:s.uP') }}">
                {{ $item->created_at->format('F d, Y') }}
            </time>
        </dd>

        @if ($item->episode || $item->season)
            <dt class="sr-only">Episode</dt>
            <dd class="text-base font-medium leading-4 text-gray-400">
                {{ $item->season }}{{ $item->episode }}
            </dd>
        @endif
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
                    class="absolute inset-0 z-0 h-full w-full bg-black object-fill text-transparent"
                    crossorigin="use-credentials"
                    loading="lazy" />

                <div class="absolute inset-0 z-20 h-full w-full">
                    <div class="absolute bottom-2 right-2 bg-black/30 px-1 py-0.5 text-xs text-gray-300">
                        {{ duration($item->duration) }}
                    </div>
                </div>

                <template x-if="preview">
                    <x-videos::player
                        x-cloak
                        x-show="preview"
                        :model="$item"
                        :manifest="$item->preview"
                        :controls="false"
                        class="absolute inset-0 z-10 h-full w-full object-fill"
                        autoplay
                        muted
                        loop />
                </template>
            </a>
        </div>
    </div>
</article>
