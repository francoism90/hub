<div class="flex flex-col space-y-8 py-8">
    <x-search::filters />

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        @forelse ($this->items as $item)
            <x-videos::item :$item />
        @empty
            <div class="flex items-center justify-center p-8 text-gray-400">
                {{ __('No videos found') }}
            </div>
        @endforelse
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
</div>
