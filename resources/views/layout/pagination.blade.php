<nav
    role="navigation"
    aria-label="Pagination Navigation"
>
    @if ($this->items->hasPages())
        <div {{ $attributes->merge(['class' => 'flex items-center justify-between py-6']) }}>
            <button
                @if ($this->items->onFirstPage()) disabled @endif
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
                {{ __(':current of :last', ['current' => $this->items->currentPage(), 'last' => $this->items->lastPage()]) }}
            </span>

            <button
                @if ($this->items->onLastPage()) disabled @endif
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
