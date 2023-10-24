<div class="flex flex-col gap-y-4 px-4 py-4">
    <div class="flex w-full flex-row flex-nowrap items-center gap-x-4 rounded bg-gray-800 px-4">
        <input
            class="input grow bg-transparent px-0 py-3 text-sm text-gray-300 placeholder:text-gray-500"
            type="search"
            placeholder="{{ __('Search on title, actor or studio') }}"
            autocomplete
            autofocus
            wire:model.live.debounce.400ms="form.query" />

        @if (filled($this->form->query))
            <a class="cursor-pointer" wire:click="$set('form.query', '')">
                <x-heroicon-o-x-mark class="h-5 w-5" />
            </a>
        @endif
    </div>

    <x-search::filters />
</div>
