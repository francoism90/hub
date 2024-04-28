@props([
    'actions',
])

<div class="absolute z-30 bottom-4 right-4 sm:-right-24">
    <nav class="flex flex-col items-center justify-center gap-y-3">
        @foreach ($actions->all() as $action)
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

