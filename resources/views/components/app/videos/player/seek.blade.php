@aware([
    'video',
])

<div class="absolute z-10 inset-x-4 bottom-4">
    <strong x-text="currentTime"></strong>
    <strong x-text="bufferedPct(buffered, duration)"></strong>


    <strong x-text="timeFormat(currentTime)"></strong>



    <input
        type="range"
        x-model="currentTime"
        x-on:input="setCurrentTime"
        :min="0"
        :max="duration"
        step="0.1"
        class="w-full"
    />
</div>
