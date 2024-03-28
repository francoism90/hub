<article
    wire:key="card-{{ $item->getRouteKey() }}"
    x-data="{ preview: false }"
    {{ $attributes->class('flex flex-wrap gap-1.5 py-7 w-full') }}
>
    <div class="h-60 max-h-60 py-2 sm:h-64 sm:max-h-64">
        <x-livewire-use::actions-link
            class="block w-full h-full"
            href="{{ route('videos.view', $item) }}"
        >
            <figure
                x-on:mouseover="preview = true"
                x-on:mouseleave="preview = false"
                x-on:touchstart.passive="preview = true"
                x-on:touchmove.passive="preview = true"
                x-on:touchend.passive="preview = false"
                class="relative h-64 w-64 bg-black"
            >
                    <img
                        alt="{{ $item->title }}"
                        src="{{ $item->thumbnail }}"
                        srcset="{{ $item->placeholder }}"
                        class="absolute inset-0 z-0 h-64 max-h-64 w-64 max-w-lg object-fill"
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
            </figure>
        </x-livewire-use::actions-link>
</article>
