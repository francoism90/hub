<div
    x-cloak
    x-show="overlay && dialog"
    x-trap.noscroll="dialog"
    x-on:click.outside="dialog = false"
    x-on:keyup.escape.window="dialog = false"
    class="absolute bottom-20 right-6 z-40 bg-secondary-800/90 border border-secondary-500/25"
>
    <div
        x-show="section === 0"
        class="px-2 min-w-64 w-64 text-sm"
    >
        <div
            class="py-1.5"
            :class="{ 'text-primary-500': ! player.isTextTrackVisible() }"
            x-on:click="player.setTextTrackVisibility(false)"
        >
            {{ __('Disabled') }}
        </div>

        <div class="grid grid-cols-1 divide-y divide-secondary-600">
            <template x-for="textTrack in player?.getTextTracks()" :key="textTrack.id">
                <div
                    class="py-1.5 cursor-pointer"
                    :class="{ 'text-primary-500': textTrack.active }"
                    x-on:click="setTextTrack(textTrack.id)"
                >
                    <span x-text="textTrack.language">
                </div>
            </template>
        </div>
    </div>
</div>
