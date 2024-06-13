@props([
    'video',
    'actions',
    'panel',
    'settings'
])

<div class="absolute inset-0 z-10 select-none">
    <x-app.player.controls.overlay />

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
