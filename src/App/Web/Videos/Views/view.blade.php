<div>
    <x-layouts::container class="py-5">
        <x-layouts::navbar />
    </x-layouts::container>

    <article>
        <x-videos::player
            :model="$video"
            :manifest="$video->stream"
            class="h-64 max-h-64 w-full bg-black lg:h-[32rem] lg:max-h-[32rem]"
            autoplay />

        <x-layouts::container class="py-1">
            <div class="grid grid-cols-1 divide-y divide-gray-700">
                <header class="py-4">
                    <dl>
                        <dt class="sr-only">Published on</dt>
                        <dd class="text-base font-medium leading-6 text-gray-400">
                            <time datetime="{{ $video->created_at->format('Y-m-d\TH:i:s.uP') }}">
                                {{ $video->created_at->format('F d, Y') }}
                            </time>
                        </dd>

                        @if ($video->episode || $video->season)
                            <dt class="sr-only">Episode</dt>
                            <dd class="text-base font-medium leading-6 text-gray-400">
                                {{ $video->season }}{{ $video->episode }}
                            </dd>
                        @endif
                    </dl>

                    <h1 class="text-xl font-extrabold capitalize tracking-tight text-gray-100 md:text-3xl">
                        {{ $video->name }}
                    </h1>
                </header>

                <div class="grid grid-cols-3 gap-4 divide-x divide-gray-700 py-3 text-center text-sm text-gray-300">
                    <a
                        class="btn hover:text-primary-300 focus:text-primary-400 active:text-primary-400"
                        wire:click="toggleFavorite">
                        <x-dynamic-component :component="$this->favorite" class="h-6 w-6" />
                    </a>

                    <a
                        class="btn hover:text-primary-300 focus:text-primary-400 active:text-primary-400"
                        wire:click="toggleWatchlist">
                        <x-dynamic-component :component="$this->watchlist" class="h-6 w-6" />
                    </a>

                    <a
                        class="btn hover:text-primary-300 focus:text-primary-400 active:text-primary-400"
                        href="{{ route('filament.admin.resources.videos.edit', $video) }}">
                        <x-heroicon-o-pencil-square class="h-5 w-5" />
                    </a>
                </div>

                @if ($video->tags->isNotEmpty())
                    <div class="space-y-1 py-4">
                        <h2 class="text-sm uppercase tracking-wide text-gray-400">{{ __('Tags') }}</h2>
                        <x-videos::tags :items="$video->tags" />
                    </div>
                @endif

                <div class="space-y-1 py-4">
                    <h2 class="text-sm uppercase tracking-wide text-gray-400">
                        {{ __('Similar videos') }}
                    </h2>

                    <div class="grid grid-cols-1 gap-4 py-4 md:grid-cols-2">
                        @forelse ($this->similar as $item)
                            <x-videos::item :$item />
                        @empty
                            <div class="flex items-center justify-center p-8 text-gray-400">
                                {{ __('No videos found') }}
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </x-layouts::container>
    </article>

    <x-layouts::footer />
</div>
