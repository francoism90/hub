@aware([
    'video',
    'actions'
])

<div class="absolute z-20 top-0 inset-x-0">
    <nav class="flex flex-row flex-nowrap items-center gap-x-4">
        @foreach ($actions as $action)
            <x-wireuse::actions-link :$action>
                <x-wireuse::actions-icon
                    :$action
                    class:icon="size-10 fill-secondary-500/90 hover:fill-secondary-100/90"
                />

                <span class="sr-only">{{ $action->getLabel() }}</span>
            </x-wireuse::actions-link>
        @endforeach
    </nav>
</div>
