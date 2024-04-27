@aware([
    'video',
    'panel'
])

<div class="absolute z-20 bottom-4 left-0">
    <div class="flex flex-row flex-nowrap items-center gap-3">
        <x-wireuse::actions-group :group="$panel" />

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
