<x-layouts::dialog>
    <a class="navbar-item">
        <x-heroicon-m-magnifying-glass
            @click="open = true"
            class="h-6 w-6 cursor-pointer" />
    </a>

    <x-slot:content>
        <div
            @keydown.escape="open = false"
            @click.away="open = false"
            class="m-5 w-full max-w-3xl rounded bg-gray-800 shadow-md sm:mt-14">

            <header class="relative flex items-center px-4">
                <x-heroicon-o-magnifying-glass class="h-6 w-6 text-gray-300" />

                <input
                    type="search"
                    class="input h-12 w-full border-transparent bg-transparent"
                    placeholder="{{ __('Search') }}"
                    autofocus
                    wire:model.live.debounce.500ms="query">

                <button
                    class="rounded-sm bg-gray-600 px-2 py-1 text-xs text-gray-200"
                    @click="open = false">
                    {{ __('ESC') }}
                </button>
            </header>

            <div
                class="flex max-h-[32rem] flex-col space-y-6 overflow-hidden overflow-y-auto border-t border-gray-700 p-6">
                @if (blank($query))
                    <div class="py-16 text-center text-gray-300">
                        No recent searches
                    </div>
                @endif

                @if ($this->videos->isNotEmpty())
                    <a class="inline-flex items-center space-x-2 text-primary-500"
                        href="{{ route('videos.index', ['search' => $this->query]) }}">
                        <h2 class="headline">
                            {{ __('Videos') }}
                        </h2>

                        <x-heroicon-o-magnifying-glass-plus class="h-6 w-6" />
                    </a>

                    <div class="grid grid-cols-1 gap-y-4">
                        @foreach ($this->videos as $video)
                            <x-videos::item :item="$video" />
                        @endforeach
                    </div>
                @endif

                @if ($this->tags->isNotEmpty())
                    <a class="inline-flex items-center space-x-2 text-primary-500">
                        <h2 class="headline">
                            {{ __('Tags') }}
                        </h2>
                    </a>

                    <div class="grid grid-cols-1 gap-y-4">
                        @foreach ($this->tags as $tag)
                            <x-tags::item :item="$tag" />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </x-slot:content>
</x-layouts::dialog>
