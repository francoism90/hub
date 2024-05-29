@aware([
    'video',
    'controls'
])

<div class="absolute bottom-0 left-0 z-20">
    <div class="flex flex-row flex-nowrap items-center gap-x-4">
        <nav class="flex flex-row flex-nowrap items-center gap-x-4">
            @foreach ($controls as $action)
                <x-wireuse::actions-link
                    :$action
                    class:label="sr-only"
                />
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
