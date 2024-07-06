@aware([
    'actions'
])

<div class="absolute inset-x-6 top-6 z-20">
    <nav class="flex flex-row flex-nowrap items-center gap-x-4">
        @foreach ($actions as $action)
            <x-wireuse::actions-link
                :$action
                class:label="sr-only"
                class:icon="size-10 fill-secondary-500/90 hover:fill-secondary-100/90"
            />
        @endforeach
    </nav>
</div>
