@aware([
    'actions',
])

<div class="absolute z-50 top-4 inset-x-4">
    <nav class="flex flex-nowrap items-center gap-x-4">
        @foreach ($actions->all() as $action)
            <x-wireuse::actions-link :$action>
                <x-wireuse::actions-icon :$action class="size-6 sm:size-7" />
                <span class="sr-only">{{ $action->getLabel() }}</span>
            </x-wireuse::actions-link>
        @endforeach
    </nav>
</div>
