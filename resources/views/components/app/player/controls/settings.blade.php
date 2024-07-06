@aware([
    'settings'
])

<div class="absolute bottom-4 right-6 z-20">
    <nav class="flex flex-row flex-nowrap items-center gap-x-4">
        @foreach ($settings as $action)
            <x-wireuse::actions-link
                :$action
                class:label="sr-only"
            />
        @endforeach
    </nav>
</div>
