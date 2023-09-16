<nav role="navigation" aria-label="Pagination Navigation">
    @if ($items->hasPages())
        <div class="flex items-center justify-between py-6">
            <button
                @if ($items->onFirstPage()) disabled @endif
                x-data
                x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="cursor-pointer text-gray-300 disabled:opacity-50"
                wire:click="previousPage"
                wire:loading.attr="disabled"
                rel="prev">
                {{ __('Previous') }}
            </button>

            <button
                @if ($items->onLastPage()) disabled @endif
                x-data
                x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="cursor-pointer text-gray-300 disabled:opacity-50"
                wire:click="nextPage"
                wire:loading.attr="disabled"
                rel="next">
                {{ __('Next') }}
            </button>
        </div>
    @endif
</nav>
