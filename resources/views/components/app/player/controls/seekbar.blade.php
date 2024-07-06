@aware([
    'controls',
])

<div class="absolute inset-x-6 bottom-14 z-0">
    <div class="relative h-1.5 w-full bg-secondary-500/50">
        <progress
            x-model="bufferedPct(buffered, duration)"
            min="0"
            max="100"
            step="any"
            class="progress progress-secondary absolute inset-0 z-10"
        ></progress>

        <progress
            x-model="currentTime"
            :min="0"
            :max="duration"
            step="any"
            class="progress progress-primary absolute inset-0 z-20"
        ></progress>

        <input
            type="range"
            x-model="currentTime"
            x-on:input="seekTo"
            :min="0"
            :max="duration"
            step="any"
            class="range range-primary absolute inset-0 z-30"
        />
    </div>
</div>
