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
            class="m-5 w-full max-w-3xl rounded-md bg-gray-800 sm:mt-14">

            <header class="relative flex items-center px-4">
                <x-heroicon-o-magnifying-glass class="h-6 w-6 text-gray-300" />

                <input
                    type="search"
                    class="input h-12 w-full border-transparent bg-transparent"
                    placeholder="{{ __('Search') }}"
                    autofocus
                    wire:model.live.debounce.300ms="form.query">

                <button
                    class="rounded-sm bg-gray-600 px-2 py-1 text-xs text-gray-300"
                    @click="open = false">
                    {{ __('ESC') }}
                </button>
            </header>

            <div class="max-h-[32rem] overflow-hidden overflow-y-auto border-t border-gray-700">
                @empty($form->query)
                    <x-layouts::queries />
                @else
                    @error('form.query')
                        <div class="px-4 py-9 text-center text-gray-400">
                            {{ $message }}
                        </div>
                    @else
                        <div class="flex flex-col space-y-4 p-4">
                            @if ($this->videos->isEmpty() && $this->tags->isEmpty())
                                <div class="px-4 py-9 text-center text-gray-400">
                                    {{ __('No results found') }}
                                </div>
                            @endif

                            @if ($this->videos->isNotEmpty())
                                <a
                                    class="inline-flex items-center space-x-2 text-primary-500"
                                    href="{{ route('videos.index', ['search' => $this->form->query]) }}"
                                    wire:navigate>
                                    <h2 class="headline">
                                        {{ __('Videos') }}
                                    </h2>

                                    <x-heroicon-o-magnifying-glass-plus class="h-5 w-5" />
                                </a>

                                <div class="grid grid-cols-1 gap-y-4">
                                    @foreach ($this->videos as $video)
                                        <x-videos::item :item="$video" />
                                    @endforeach
                                </div>
                            @endif

                            @if ($this->tags->isNotEmpty())
                                <a
                                    class="inline-flex items-center space-x-2 text-primary-500"
                                    wire:navigate>
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
                    @enderror
                @endempty
            </div>
        </div>
    </x-slot:content>
</x-layouts::dialog>
