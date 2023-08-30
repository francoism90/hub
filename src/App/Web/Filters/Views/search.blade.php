<div class="w-full rounded bg-gray-900/70 p-6 shadow-md">
    <div class="flex items-center justify-between pb-4">
        <h3 class="headline">{{ __('Search') }}</h3>
    </div>

    <div class="flex flex-col space-y-3">
        <input
            class="input"
            type="search"
            autocomplete
            wire:model.live.debounce.500ms="search" />
    </div>
</div>
