<article
    wire:key="card-{{ $item->getRouteKey() }}"
    x-data="{ preview: false }"
    {{ $attributes->class('flex flex-row flex-wrap gap-1.5 py-7 w-full') }}
>
    <div class="flex flex-wrap flex-grow md:flex-nowrap gap-6">
        <x-livewire-use::actions-link
            class="grow h-64 w-full md:w-96 md:max-w-96 bg-black"
            href="{{ route('videos.view', $item) }}"
        >
            <figure
                x-on:mouseover="preview = true"
                x-on:mouseleave="preview = false"
                x-on:touchstart.passive="preview = true"
                x-on:touchmove.passive="preview = true"
                x-on:touchend.passive="preview = false"
                class="relative h-full w-full md:w-96 md:max-w-96 bg-black"
            >
                    <img
                        alt="{{ $item->title }}"
                        src="{{ $item->thumbnail }}"
                        srcset="{{ $item->placeholder }}"
                        class="absolute inset-0 z-0 h-full w-full object-fill"
                        crossorigin="use-credentials"
                        loading="lazy"
                    />

                    <div class="absolute inset-0 z-20 h-full w-full">
                        <div class="z-30 absolute bottom-2 right-2 flex items-center gap-x-1.5 bg-black/30 px-1 py-0.5 text-xs font-medium text-gray-300">
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

        <div class="grow">
            <div class="flex flex-col gap-y-0.5">
                <x-livewire-use::actions-link
                    class="line-clamp-2 text-2xl font-bold capitalize leading-8 tracking-tight"
                    href="{{ route('videos.view', $item) }}"
                    aria-label="{{ $item->title }}"
                    title="{{ $item->title }}"
                >
                    {{ $item->title }}
                </x-livewire-use::actions-link>

                <dl class="inline-flex items-center">
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

                @if ($item->summary)
                    <p class="prose prose-slate"">
                        {{ $item->summary }}
                    </p>
                @endif

                @if ($item->tags->isNotEmpty())
                    <x-app::videos-tags class="py-3" :items="$item->tags" />
                @endif
            </div>
        </div>
    </div>
</article>
