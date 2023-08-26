<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container>
        <main class="flex sm:space-x-24">
            <div class="grid grid-cols-1 divide-y divide-gray-700">
                @foreach ($items as $item)
                    <x-videos::item :item="$item" />
                @endforeach

                @if ($items->hasPages())
                    <nav role="navigation" aria-label="Pagination Navigation">
                        <span>
                            @if ($items->onFirstPage())
                                <span>Previous</span>
                            @else
                                <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev">Previous</button>
                            @endif
                        </span>

                        <span>
                            @if ($items->onLastPage())
                                <span>Next</span>
                            @else
                                <button wire:click="nextPage" wire:loading.attr="disabled" rel="next">Next</button>
                            @endif
                        </span>
                    </nav>
                @endif
            </div>

            <livewire:videos-filter />
        </main>
    </x-layouts::container>
</div>
