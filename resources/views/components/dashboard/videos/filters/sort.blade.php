@props([
    'action',
])

<x-dashboard.videos.filters.dialog :$action>
    @foreach ($action->all() as $option)
        <div class="flex items-center gap-3 text-sm">
            <input
                type="radio"
                id="{{ $option->getName() }}"
                value="{{ $option->getName() }}"
                wire:model.live="form.sort"
            />

            <label for="{{ $option->getName() }}">
                {{ $option->getLabel() }}
            </label>
        </div>
    @endforeach
</x-dashboard.videos.filters.dialog>
