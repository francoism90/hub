<div class="w-full p-4">
    <input
        class="input rounded bg-gray-800 px-4 py-3 text-sm text-gray-300 placeholder:text-gray-500"
        type="search"
        placeholder="{{ __('Search on title, actor or studio') }}"
        autocomplete
        wire:model.live.debounce.400ms="form.query" />
</div>
