@aware([
    'video',
])

<div class="absolute z-10 inset-x-4 bottom-4">
    {{-- <input x-model="currentTime" x-mask:dynamic="creditCardMask" class="text-white bg-transparent"> --}}

    <strong x-text="timeFormat(currentTime)"></strong>

        {{-- Time: <strong x-show="currentTime > 1" x-text="currentTime"></strong> --}}
        {{-- Time: <strong x-text="duration"></strong> --}}
    {{-- </div> --}}

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
