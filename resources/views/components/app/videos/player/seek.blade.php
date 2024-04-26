@aware([
    'video',
])

<div class="absolute z-10 inset-x-4 bottom-24">
    {{-- <strong x-text="bufferedPct(buffered, duration)"></strong> --}}
    {{-- <strong x-text="timeFormat(currentTime)"></strong> --}}

    <div class="relative w-full bg-secondary-500/50 h-1">
        <progress
            x-model="bufferedPct(buffered, duration)"
            max="100"
            class="progress progress-secondary absolute z-0 inset-0 h-full w-full"
        ></progress>

        <progress
            x-model="currentTime"
            :max="duration"
            class="progress progress-primary absolute z-10 inset-0 h-full w-full"
        ></progress>

        <input
            type="range"
            x-model="currentTime"
            x-on:input="setCurrentTime"
            min="0"
            :max="duration"
            step="0.1"
            class="range range-primary absolute z-30 w-full"
        />
    </div>
</div>
