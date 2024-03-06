<x-livewire-use::container class="pt-4">
    <x-livewire-use::form>
        <x-livewire-use::layout.join class="flex-nowrap gap-x-4 rounded bg-gray-800 px-3">
            <x-livewire-use::form.input
                class="bg-transparent border-0 py-2.5 px-0"
                type="search"
                placeholder="{{ __('Search on title, actor or studio') }}"
                autocomplete
                autofocus
                wire:model.live.debounce.300ms="form.search"
            />

            @if ($this->form->hasSearch())
                <x-livewire-use::actions.button wire:click.prevent="$set('form.search', '')">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </x-livewire-use::actions.button>
            @endif
        </x-livewire-use::layout.join>

        @if ($this->form->hasSearch())
            <div class="w-full">
                <x-app::search-filters />
            </div>
        @endif
    </x-livewire-use::form>

    <div class="flex flex-col pt-4 gap-y-8">
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
</x-livewire-use::container>
