<x-wireui::layout-container class="pt-4">
    <x-wireui::forms-schema class:layout="flex flex-col gap-y-2">
        <x-wireui::layout-join class="flex-nowrap gap-x-4 rounded bg-gray-800 px-3">
            <x-wireui::forms-input
                class="border-0 bg-transparent px-0 py-2.5"
                type="search"
                placeholder="{{ __('Search on title, actor or studio') }}"
                autocomplete
                autofocus
                wire:model.live.debounce.300ms="form.search"
            />

            @if ($this->form->filled('search'))
                <x-wireui::actions-button wire:click.prevent="$set('form.search', '')">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </x-wireui::actions-button>
            @endif
        </x-wireui::layout-join>

        @if ($this->form->filled('search'))
            <x-app::search-filters />
        @endif
    </x-wireui::forms-schema>

    <div class="flex flex-col gap-y-8 pt-4">
        <div
            class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2"
            wire:poll.keep-alive.2400s
        >
            @foreach ($this->items as $item)
                <x-app::videos-item :$item />
            @endforeach
        </div>

        {{ $this->items->links('pagination.default') }}
    </div>
</x-wireui::layout-container>
