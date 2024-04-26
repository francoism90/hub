@props([
    'navigation',
])

<div class="absolute z-30 top-4 inset-x-4">
    <nav class="flex flex-nowrap items-center gap-x-4">
        @foreach ($navigation->items as $action)
            <x-wireuse::actions-link
                :$action
                class:label="sr-only"
                class:icon="size-8 text-secondary-200"
            />
        @endforeach
    </nav>
</div>
