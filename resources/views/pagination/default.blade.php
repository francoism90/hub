<nav
    role="navigation"
    aria-label="Pagination Navigation"
>
    @if ($paginator->hasPages())
        <div class="flex items-center justify-between py-6">
            <button
                @if ($paginator->onFirstPage()) disabled @endif
                x-data
                x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="cursor-pointer text-gray-300 disabled:opacity-50"
                wire:click="previousPage"
                wire:loading.attr="disabled"
                rel="prev"
            >
                {{ __('Previous') }}
            </button>

            <span class="text-sm text-gray-300">
                {{ __(':current of :last', ['current' => $paginator->currentPage(), 'last' => $paginator->lastPage()]) }}
            </span>

            <button
                @if ($paginator->onLastPage()) disabled @endif
                x-data
                x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="cursor-pointer text-gray-300 disabled:opacity-50"
                wire:click="nextPage"
                wire:loading.attr="disabled"
                rel="next"
            >
                {{ __('Next') }}
            </button>
        </div>
    @endif
</nav>
