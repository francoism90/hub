@props([
    'settings',
])

<div class="absolute z-30 top-0 left-3">
    <nav class="flex h-16 items-center gap-x-3 overflow-x-auto">
        @foreach ($settings->all() as $action)
            <x-wireuse::actions-link :$action>
                <x-wireuse::actions-icon
                    :$action
                    class="size-6 sm:size-7"
                />

                <span class="sr-only">{{ $action->getLabel() }}</span>
            </x-wireuse::actions-link>
        @endforeach
    </nav>
</div>
