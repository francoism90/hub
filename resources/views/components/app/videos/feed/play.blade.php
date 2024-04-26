@props([
    'play',
])

<div class="absolute z-40 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
    <x-wireuse::actions-link
        :action="$play"
        class:label="sr-only"
        class:icon="size-24 text-secondary-100"
    />
</div>
