<x-livewire-use::container class="flex flex-col gap-y-4">
    start
    <x-livewire-use::form>
        <x-livewire-use::actions.button label="hoi" />

        <x-livewire-use::form.input id="name" />

    </x-livewire-use::form>

    {{-- <div class="py-4">
        <x-forms-input
            class:base="rounded bg-gray-800 border-0 w-full text-sm px-2 py-1.5"
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

        @if ($this->form->hasSearch())
            <x-search-filters />
        @endif
    </div>

    <div class="flex flex-col gap-y-8">
        <div
            class="grid grow grid-cols-1 gap-3.5 sm:grid-cols-2"
            wire:poll.keep-alive.2400s
        >
            @foreach ($this->items as $item)
                <x-videos-item :$item />
            @endforeach
        </div>

        {{ $this->items->links('pagination.default') }}
    </div> --}}
</x-livewire-use::container>
