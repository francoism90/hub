@props([
    'action',
])

<x-dashboard.videos.filters.dialog>
    @foreach ($action->getNodes() as $option)
        <div class="flex items-center gap-3 text-sm">
            <input
                type="checkbox"
                wire:model.live="form.visibility"
                id="{{ $option->getName() }}"
                value="{{ $option->getName() }}"
            />

            <label for="{{ $option->getName() }}">
                {{ $option->getLabel() }}
            </label>
        </div>
    @endforeach
</x-dashboard.videos.filters.dialog>
