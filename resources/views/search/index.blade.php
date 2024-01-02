<x-ui-container class="flex flex-col gap-y-4">
    <div class="p-4">
        <div class="flex w-full flex-row flex-nowrap items-center gap-x-4 rounded bg-gray-800 px-4">
            <x-forms-text-input
                class="input bg-transparent px-0 text-sm text-gray-300 placeholder:text-gray-500"
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
            </x-forms-text-input>
        </div>
    </div>

    <x-search-filters />
    <x-search-items />
</x-ui-container>
