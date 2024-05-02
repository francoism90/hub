@props([
    'action',
])

<x-dashboard.videos.filters.dialog>
    <div class="flex items-center w-full gap-3 text-sm">
        <x-dashboard.forms.input
            label="{{ __('Search') }}"
            id="form.query"
            wire:model.live.debounce.300ms="form.query"
        />
    </div>
</x-dashboard.videos.filters.dialog>
