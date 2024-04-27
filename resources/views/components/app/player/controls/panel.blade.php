@props([
    'video',
    'controls'
])

<div class="absolute z-10 bottom-8 left-6">
    <div class="flex flex-row flex-nowrap items-center gap-3">
        <x-wireuse::actions-group
            :group="$controls"
            {{-- class:layer="flex items-center overflow-x-auto gap-x-5 px-3 border-b border-secondary-500/50" --}}
            {{-- class:item="py-3 border-b text-sm font-medium" --}}
            {{-- class:active="border-primary-400 text-primary-400" --}}
            {{-- class:inactive="border-secondary-400 text-secondary-400" --}}
        />

        <p class="text-sm font-medium">
            <span x-text="timeFormat(currentTime)"></span> /
            <span x-text="timeFormat(duration)"></span>
        </p>
    </div>
</div>
