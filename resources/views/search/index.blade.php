<x-ui-container class="flex flex-col gap-y-4">
    <div class="pt-4">
        <div class="flex w-full flex-row flex-nowrap items-center gap-x-4 rounded bg-gray-800 px-4">
            <x-forms-input
                class="input-ghost px-0 text-sm"
                type="search"
                placeholder="{{ __('Search on title, actor or studio') }}"
                autocomplete
                autofocus
                wire:model.live.debounce.300ms="form.search"
            >
                <x-slot:append>
                    @if ($this->form->hasSearch())
                        <button wire:click.prevent="$set('form.search', '')">
                            <x-heroicon-o-x-mark class="h-5 w-5" />
                        </button>
                    @endif
                </x-slot:append>
            </x-forms-input>
        </div>

        <x-search-filters />
    </div>

    <div class="flex flex-col gap-y-8">
        <div
            class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2"
            wire:poll.keep-alive.10s
        >
            @foreach ($this->items as $item)
                <x-videos-item :$item />
            @endforeach
        </div>

        {{ $this->items->links('pagination.default') }}
    </div>
</x-ui-container>
