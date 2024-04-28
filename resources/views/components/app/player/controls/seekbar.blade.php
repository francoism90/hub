@aware([
    'video',
])

<div class="absolute z-20 bottom-16 inset-x-0">
    <div class="relative h-1.5 w-full bg-secondary-500/50">
        <progress
            x-model="bufferedPct(buffered, duration)"
            min="0"
            max="100"
            class="progress progress-secondary h-full w-full absolute z-0 inset-0"
        ></progress>

        <progress
            x-model="currentTime"
            :min="0"
            :max="duration"
            class="progress progress-primary h-full w-full absolute z-10 inset-0"
        ></progress>

        <input
            type="range"
            x-model="currentTime"
            x-on:input="seekTo"
            :min="0"
            :max="duration"
            step="0.1"
            class="range range-primary h-full w-full absolute z-20 inset-0"
        />
    </div>
</div>
