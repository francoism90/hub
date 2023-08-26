<x-layouts::dialog>
    <x-heroicon-m-magnifying-glass
        @click="open = true"
        class="h-6 w-6 cursor-pointer" />

    <x-slot:content>
        <div class="m-5 w-full max-w-3xl rounded bg-gray-800 shadow-md sm:mt-14">
            <header class="relative flex items-center space-x-4 px-4">
                <x-heroicon-o-magnifying-glass class="h-6 w-6 text-gray-300" />

                <input
                    type="search"
                    class="h-12 w-full border-transparent bg-transparent focus:outline-none"
                    placeholder="{{ __('Search') }}"
                    wire:model.live.debounce.250ms="search">

                <button
                    class="rounded-sm bg-gray-600 px-2 py-1 text-xs text-gray-200"
                    @click="open = false">
                    {{ __('ESC') }}
                </button>
            </header>

            <div class="flex max-h-[32rem] flex-col space-y-6 overflow-auto border-t border-gray-700 p-6">
                @if (blank($search))
                    <div class="py-16 text-center text-gray-300">
                        No recent searches
                    </div>
                @endif

                @if ($videos->isNotEmpty())
                    <h2 class="headline">
                        <a href="{{ route('videos.index', compact('search')) }}">
                            {{ __('Videos') }}
                        </a>
                    </h2>

                    <div class="grid grid-cols-1 gap-y-4">
                        @foreach ($videos as $video)
                            <x-videos::item :item="$video" />
                        @endforeach
                    </div>
                @endif

                @if ($tags->isNotEmpty())
                    <h2 class="headline">{{ __('Tags') }}</h2>

                    <div class="grid grid-cols-1 gap-y-4">
                        @foreach ($tags as $tag)
                            <x-tags::item :item="$tag" />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </x-slot:content>
</x-layouts::dialog>
