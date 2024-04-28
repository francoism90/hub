@aware([
    'video',
    'panel'
])

<div class="absolute z-20 bottom-4 left-0">
    <div class="flex flex-row flex-nowrap items-center gap-x-4">
        <nav class="flex flex-row flex-nowrap items-center gap-x-4">
            @foreach ($panel->all() as $action)
                <x-wireuse::actions-link :$action>
                    <x-wireuse::actions-icon
                        :$action
                        class="size-6"
                    />

                    <span class="sr-only">{{ $action->getLabel() }}</span>
                </x-wireuse::actions-link>
            @endforeach
        </nav>

        <div
            x-cloak
            x-show="currentTime >= 0 && duration >= 0"
            class="text-sm font-medium"
        >
            <span x-text="timeFormat(currentTime)"></span> /
            <span x-text="timeFormat(duration)"></span>
        </div>
    </div>
</div>
