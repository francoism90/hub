<article>
    <x-videos::player
        :item="$video"
        :manifest="$video->stream"
        :starts-at="$this->starts"
        @timeupdate.throttle.750ms="timeUpdate"
        autoplay />

    <x-layouts::container class="py-1">
        <div class="grid grid-cols-1 divide-y divide-gray-700">
            <header class="py-3.5">
                <dl>
                    <dt class="sr-only">{{ __('Published on') }}</dt>
                    <dd class="text-base font-medium leading-6 text-gray-400">
                        <time datetime="{{ $video->published->format('Y-m-d\TH:i:s.uP') }}">
                            {{ $video->published->format('F d, Y') }}
                        </time>
                    </dd>

                    @if ($video->episode || $video->season)
                        <dt class="sr-only">{{ __('ID') }}</dt>
                        <dd class="text-base font-medium leading-6 text-gray-400">
                            {{ $video->identifier }}
                        </dd>
                    @endif
                </dl>

                <h1 class="text-xl font-extrabold capitalize tracking-tight text-gray-100 md:text-3xl">
                    {{ $video->title }}
                </h1>
            </header>

            <div class="grid grid-cols-3 gap-3.5 divide-x divide-gray-700 py-3 text-center text-sm text-gray-300">
                <a
                    class="btn hover:text-primary-300 focus:text-primary-400 active:text-primary-400"
                    wire:click="toggleFavorite">
                    <x-icon :name="$this->favorited" class="h-6 w-6" />
                </a>

                <a
                    class="btn hover:text-primary-300 focus:text-primary-400 active:text-primary-400"
                    wire:click="toggleWatchlist">
                    <x-icon :name="$this->watchlisted" class="h-6 w-6" />
                </a>

                <a
                    class="btn hover:text-primary-300 focus:text-primary-400 active:text-primary-400"
                    href="{{ route('filament.admin.resources.videos.edit', $video) }}">
                    <x-heroicon-o-pencil-square class="h-5 w-5" />
                </a>
            </div>

            @if ($video->tags->isNotEmpty())
                <div class="gap-y-3 py-3.5">
                    <h2 class="text-sm uppercase tracking-wide text-gray-400">{{ __('Tags') }}</h2>
                    <x-videos::tags class="pt-2" :items="$video->tags" />
                </div>
            @endif

            <div class="py-3.5">
                <h2 class="text-sm uppercase tracking-wide text-gray-400">
                    {{ __('Similar videos') }}
                </h2>

                <div class="grid grow grid-cols-1 gap-3.5 py-3.5 sm:grid-cols-2" wire:poll.keep-alive.10s>
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

@push('scripts')
    <script>
        function timeUpdate(e) {
            const time = e.target.currentTime || 0

            @this.dispatch('time-update', {
                time
            })
        }
    </script>
@endpush
