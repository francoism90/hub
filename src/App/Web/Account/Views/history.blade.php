<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container class="flex flex-row flex-nowrap sm:space-x-24">
        <div class="grid grid-cols-1 divide-y divide-gray-700">
            @if (filled($search))
                <div class="inline-flex flex-nowrap items-center justify-between pb-4 text-sm text-gray-400">
                    <div class="line-clamp-1 pr-4">
                        <span>{{ __('filter by') }}</span>
                        <span class="lowercase">{{ implode(' + ', array_filter([$search])) }}</span>
                    </div>

                    <div>
                        <a class="cursor-pointer" wire:click="resetQuery('search')">
                            <x-heroicon-o-x-circle class="h-6 w-6" />
                        </a>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-9 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($items as $item)
                    <x-videos::card :$item />
                @endforeach
            </div>

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
    </x-layouts::container>

    <x-layouts::footer />
</div>
