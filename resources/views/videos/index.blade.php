<x-ui-container class="flex flex-row flex-nowrap sm:space-x-24">
    <div
        class="grid grow grid-cols-1 divide-y divide-gray-700"
        wire:poll.keep-alive.10s
    >
        @forelse ($this->items as $item)
            <x-videos-card :$item />
        @empty
            <div class="flex items-center justify-center p-8 text-gray-400">
                {{ __('No videos found') }}
            </div>
        @endforelse

        <x-ui-simple-pagination />
    </div>

    <aside class="hidden w-full min-w-[18rem] max-w-[18rem] flex-col gap-y-4 self-start sm:flex">
        <div class="flex w-full flex-col gap-y-7 py-3.5">

        </div>
    </aside>
</x-ui-container>
