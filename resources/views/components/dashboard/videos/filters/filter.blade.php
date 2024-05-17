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

    @foreach ($action->getNodes() as $option)
        <div class="flex items-center gap-3 text-sm">
            <input
                type="checkbox"
                id="{{ $option->getName() }}"
                value="{{ $option->getName() }}"
                wire:model.live="form.untagged"
            />

            <label for="{{ $option->getName() }}">
                {{ $option->getLabel() }}
            </label>
        </div>
    @endforeach
</x-dashboard.videos.filters.dialog>
