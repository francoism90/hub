<nav
    role="navigation"
    aria-label="Pagination Navigation"
>
    @if ($paginator->hasPages())
        <div class="flex items-center justify-between py-6" x-data>
            <button
                @if ($paginator->onFirstPage()) disabled @endif
                x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="cursor-pointer text-gray-300 disabled:opacity-50"
                wire:click="previousPage"
                wire:loading.attr="disabled"
                rel="prev"
            >
                {{ __('Previous') }}
            </button>

            <button
                @if ($paginator->onLastPage()) disabled @endif
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
