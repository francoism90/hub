@aware([
    'video',
])
<div class="absolute inset-x-0 bottom-16 z-20">
    <div class="relative h-1.5 w-full bg-secondary-500/50">
        <progress
            x-model="bufferedPct(buffered, duration)"
            min="0"
            max="100"
            class="progress progress-secondary absolute inset-0 z-0 h-full w-full"
        ></progress>

        <progress
            x-model="currentTime"
            :min="0"
            :max="duration"
            class="progress progress-primary absolute inset-0 z-10 h-full w-full"
        ></progress>

        <input
            type="range"
            x-model="currentTime"
            x-on:input="seekTo"
            :min="0"
            :max="duration"
            step="0.1"
            class="range range-primary absolute inset-0 z-20 h-full w-full"
        />
    </div>
</div>
