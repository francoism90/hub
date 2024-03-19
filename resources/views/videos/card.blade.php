<article
    wire:key="card-{{ $item->getRouteKey() }}"
    x-data="{ preview: false }"
    {{ $attributes->class('flex flex-col gap-y-1.5 py-7 w-full max-w-lg') }}
>
    <dl class="inline-flex">
        <dt class="sr-only">{{ __('Published on') }}</dt>
        <dd class="text-base font-medium leading-4 text-gray-400">
            <time datetime="{{ $item->published->format('Y-m-d\TH:i:s.uP') }}">
                {{ $item->published->format('F d, Y') }}
            </time>
        </dd>

        @if ($item->identifier)
            <dt class="sr-only">{{ __('ID') }}</dt>
            <dd class="text-base font-medium leading-4 text-gray-400">
                {{ $item->identifier }}
            </dd>
        @endif
    </dl>

    <h2 class="line-clamp-2 text-2xl font-bold capitalize leading-8 tracking-tight">
        <x-livewire-use::actions-link
            href="{{ route('videos.view', $item) }}"
            aria-label="{{ $item->title }}"
            title="{{ $item->title }}"
        >
            {{ $item->title }}
        </x-livewire-use::actions-link>
    </h2>

    @if ($item->tags->isNotEmpty())
        <x-app::videos-tags :items="$item->tags" />
    @endif

    <div class="h-60 max-h-60 py-2 sm:h-64 sm:max-h-64">
        <div
            x-on:mouseover="preview = true"
            x-on:mouseleave="preview = false"
            x-on:touchstart.passive="preview = true"
            x-on:touchmove.passive="preview = true"
            x-on:touchend.passive="preview = false"
            class="relative h-full w-full bg-black"
        >
            <x-livewire-use::actions-link href="{{ route('videos.view', $item) }}">
                <img
                    alt="{{ $item->title }}"
                    src="{{ $item->thumbnail }}"
                    srcset="{{ $item->placeholder }}"
                    class="absolute inset-0 z-0 h-full max-h-64 w-full max-w-lg object-fill"
                    crossorigin="use-credentials"
                    loading="lazy"
                />

                <div class="absolute inset-0 z-20 h-full w-full">
                    <div class="absolute bottom-2 right-2 flex items-center gap-x-1.5 bg-black/30 px-1 py-0.5 text-xs font-medium text-gray-300">
                        @if ($item->caption)
                            <span>{{ __('CC') }}</span>
                        @endif

                        <span>{{ duration($item->duration) }}</span>
                    </div>
                </div>

                <template x-if="preview">
                    <x-app::videos-player
                        :$item
                        :manifest="$item->preview"
                        :controls="false"
                        :rate="1.05"
                        class="absolute inset-0 z-10 h-full w-full object-fill"
                        autoplay
                        muted
                        loop
                    />
                </template>
            </x-livewire-use::actions-link>
        </div>
    </div>
</article>
