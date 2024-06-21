@props([
    'actions',
])

<x-wireuse::layout.container class="flex flex-nowrap items-center gap-x-3 overflow-x-auto" fluid>
    @foreach ($actions as $action)
        <x-wireuse::actions-button
            :$action
            class:label="text-sm font-medium"
        />
    @endforeach
</x-wireuse::layout.container>
