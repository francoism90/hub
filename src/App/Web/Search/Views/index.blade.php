<x-layouts::container>
    <div class="flex flex-col gap-y-4 p-4">
        <div class="flex w-full flex-row flex-nowrap items-center gap-x-4 rounded bg-gray-800 px-4">
            <x-forms-text-input
                label="{{ __('foo2') }}"
                icon="{{ __('foo') }}"
                class="input grow bg-transparent px-0 py-3 text-sm text-gray-300 placeholder:text-gray-500"
                type="search"
                placeholder="{{ __('Search on title, actor or studio') }}"
                autocomplete
                autofocus
                wire:model.live.debounce.300ms="form.search"
            />

            {{-- @if (filled($this->form->search))
                <a
                    class="cursor-pointer"
                    wire:click="$set('form.search', '')"
                >
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                </a>
            @endif --}}
        </div>

    </div>
        {{-- <x-search::filters /> --}}

    {{-- <x-search::query /> --}}
    {{-- <x-search::items /> --}}
</x-layouts::container>
