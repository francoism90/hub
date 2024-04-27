@aware([
    'video',
    'controls'
])

<div class="absolute z-10 bottom-4 left-6">
    <div class="flex flex-row flex-nowrap items-center gap-3">
        <x-wireuse::actions-group :group="$controls" />

        <p class="text-sm font-medium">
            <span x-text="timeFormat(currentTime)"></span> /
            <span x-text="timeFormat(duration)"></span>
        </p>
    </div>
</div>
