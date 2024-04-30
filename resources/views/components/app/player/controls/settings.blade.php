@aware([
    'video',
    'settings'
])

<div class="absolute z-20 bottom-4 right-0">
    <nav class="flex flex-row flex-nowrap items-center gap-x-4">
        @foreach ($settings->getNodes() as $action)
            <x-wireuse::actions-link :$action>
                <x-wireuse::actions-icon
                    :$action
                    class="size-6"
                />

                <span class="sr-only">{{ $action->getLabel() }}</span>
            </x-wireuse::actions-link>
        @endforeach
    </nav>
</div>
