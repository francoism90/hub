<div class="flex flex-col gap-y-8 py-8">
    @if (filled($this->form->query) && blank($this->items))
        <div class="flex w-full items-center justify-center p-8 text-gray-400">
            {{ __('No results match your search criteria') }}
        </div>
    @endif

    @if (filled($this->form->query) && filled($this->items))
        <div class="grid grid-cols-1 gap-4">
            @foreach ($this->items as $item)
                <x-videos::item :$item />
            @endforeach
        </div>

        <nav
            role="navigation"
            aria-label="Pagination Navigation"
            class="flex w-full items-center justify-center py-4">
            <button
                @if ($this->onLastPage) disabled @endif
                class="btn w-auto rounded bg-gray-800 px-2.5 py-1 text-sm text-gray-300 disabled:opacity-50"
                wire:click="nextPage"
                wire:loading.attr="disabled"
                rel="next">
                <span>{{ __('More Results') }}</span>
                <x-heroicon-m-chevron-down class="h-4 w-4" />
            </button>
        </nav>
    @endempty
</div>
