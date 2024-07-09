<div class="absolute bottom-6 left-3 z-20">
    <div class="flex flex-row flex-nowrap items-center gap-x-4">
        <nav class="flex flex-row flex-nowrap items-center gap-x-4">
            {{ html()->button()->attribute('x-on:click', 'togglePlayback')->children([
                html()->icon()->svg('heroicon-s-pause', 'size-6')->attributes(['x-cloak', 'x-show' => 'paused']),
                html()->icon()->svg('heroicon-s-play', 'size-6')->attributes(['x-cloak', 'x-show' => '! paused']),
            ]) }}
        </nav>

        <div
            x-cloak
            x-show="currentTime >= 0 && duration >= 0"
            x-transition
            class="text-xs font-medium text-secondary-300"
        >
            <span x-text="timeFormat(currentTime || 0)"></span> /
            <span x-text="timeFormat(duration || 0)"></span>
        </div>
    </div>
</div>
