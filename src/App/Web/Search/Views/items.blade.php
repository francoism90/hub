<div class="flex flex-col space-y-8 py-8">
    <div class="flex w-full flex-row">
        <x-layouts::dropdown>
            <button class="btn text-sm font-semibold">
                <span>{{ $sorter }}</span>
                <x-heroicon-m-chevron-down
                    class="h-4 w-4"
                    x-bind:class="open ? 'rotate-180' : ''" />
            </button>

            <x-slot:content>
                <div class="absolute left-0 top-8 w-48 min-w-[12rem] bg-gray-900 py-2">
                    @foreach ($sorters as $sorter => $label)
                        <button
                            class="btn @if ($sorter === $this->sort) btn-gradient @endif justify-start px-4 py-2 text-sm"
                            wire:click="$set('sort', '{{ $sorter }}')">
                            <span>{{ $label }}</span>
                            @if ($sorter === $this->sort)
                                <x-heroicon-o-check class="h-4 w-4" />
                            @endif
                        </button>
                    @endforeach
                </div>
            </x-slot:content>

        </x-layouts::dropdown>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        @forelse ($items as $item)
            <x-videos::item :$item />
        @empty
            <div class="flex items-center justify-center p-8 text-gray-400">
                {{ __('No videos found') }}
            </div>
        @endforelse
    </div>
</div>
