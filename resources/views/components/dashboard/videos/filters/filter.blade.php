@props([
    'action',
])

<x-dashboard.videos.filters.dialog>
    <div class="flex items-center w-full gap-3 text-sm">
        <x-dashboard.forms.input
            id="form.query"
            placeholder="{{ __('Search') }}"
            autofocus
            wire:model.live.debounce.300ms="form.query"
        />
    </div>
</x-dashboard.videos.filters.dialog>
