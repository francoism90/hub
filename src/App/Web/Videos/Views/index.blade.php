<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container class="flex flex-row flex-nowrap sm:space-x-24">
        <div class="grow">
            <div class="grid grid-cols-1 divide-y divide-gray-700">
                @foreach ($items as $item)
                    <x-videos::item :item="$item" />
                @endforeach

                @if ($items->hasPages())
                    <nav
                        role="navigation"
                        aria-label="Pagination Navigation"
                        class="flex items-center justify-between py-6">
                        <button
                            @if ($items->onFirstPage()) disabled @endif
                            x-data
                            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                            class="cursor-pointer text-gray-300 disabled:opacity-50"
                            wire:click="previousPage"
                            wire:loading.attr="disabled"
                            rel="prev">
                            {{ __('Previous') }}
                        </button>

                        <span class="text-sm text-gray-300">
                            {{ __(':current of :last', ['current' => $items->currentPage(), 'last' => $items->lastPage()]) }}
                        </span>

                        <button
                            @if ($items->onLastPage()) disabled @endif
                            x-data
                            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                            class="cursor-pointer text-gray-300 disabled:opacity-50"
                            wire:click="nextPage"
                            wire:loading.attr="disabled"
                            rel="next">
                            {{ __('Next') }}
                        </button>
                    </nav>
                @endif
            </div>
        </div>

        <livewire:videos-filter />
    </x-layouts::container>

    <x-layouts::footer />
</div>
