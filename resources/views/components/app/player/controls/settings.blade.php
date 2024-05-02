@aware([
    'video',
    'settings'
])

<div class="absolute bottom-4 right-0 z-20">
    <nav class="flex flex-row flex-nowrap items-center gap-x-4">
        @foreach ($settings as $action)
        <x-wireuse::actions-link :$action>
            <x-wireuse::actions-icon :$action />
            <span class="sr-only">{{ $action->getLabel() }}</span>
        </x-wireuse::actions-link>
        @endforeach
    </nav>
</div>
