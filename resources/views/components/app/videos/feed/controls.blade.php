@props([
    'controls',
])

<div class="absolute z-30 bottom-4 right-4 sm:-right-2">
    <nav class="flex flex-col flex-nowrap items-center justify-center gap-y-4">
        {{-- @foreach ($controls->items as $action)
            <x-wireuse::actions-link
                :$action
                class:label="sr-only"
                class:icon="size-8 text-secondary-200"
            />
        @endforeach --}}
    </nav>
</div>
