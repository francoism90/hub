@props([
    'settings',
])

<div class="absolute z-30 top-0 left-0">
    <nav class="flex h-16 items-center justify-between gap-x-3 overflow-x-auto sm:justify-center sm:gap-x-12">
        @foreach ($settings->all() as $action)
            <x-wireuse::actions-link
                :$action
                class="flex-col max-w-16 gap-1 px-3"
            >
                <x-wireuse::actions-icon
                    :$action
                    class="size-6 sm:size-7"
                />

                <span class="sr-only">{{ $action->getLabel() }}</span>
            </x-wireuse::actions-link>
        @endforeach
    </nav>
</div>
