@props([
    'video',
    'actions',
    'panel',
    'settings'
])

<div class="absolute inset-0 z-0">
    <div class="size-full grid grid-cols-2 gap-x-4">
        <div x-on:dblclick.debounce="backward"></div>
        <div x-on:dblclick.debounce="forward"></div>
    </div>

    <div
        x-cloak
        x-show="overlay"
        x-transition
    >
        <x-app.player.controls.dialog />
        <x-app.player.controls.navigation />
        <x-app.player.controls.details />
        <x-app.player.controls.seekbar />
        <x-app.player.controls.playback />
        <x-app.player.controls.settings />
    </div>
</div>
