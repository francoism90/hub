<div>
    <x-layouts::container class="py-10">
        <x-layouts::navbar />
    </x-layouts::container>

    <x-layouts::container>
        <x-search::query />

        @if (filled($form->query))
            <x-search::items />

            @if (!$lastPage)
                <nav
                    role="navigation"
                    aria-label="Pagination Navigation"
                    class="flex w-full items-center justify-center py-4">
                    <button
                        class="btn w-auto rounded bg-gray-800 px-2.5 py-1 text-sm text-gray-300 disabled:opacity-50"
                        wire:click="nextPage"
                        wire:loading.attr="disabled"
                        rel="next">
                        <span>{{ __('More Results') }}</span>
                        <x-heroicon-m-chevron-down class="h-4 w-4" />
                    </button>
                </nav>
            @endif
        @endif
    </x-layouts::container>

    <x-layouts::footer />
</div>
