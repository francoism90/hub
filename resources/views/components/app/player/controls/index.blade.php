@props([
    'video',
    'actions',
    'panel',
    'settings'
])

<div
    x-cloak
    x-show="overlay"
    x-transition
    class="absolute z-10 inset-6"
>
    <x-app.player.controls.navigation />
    <x-app.player.controls.details />
    <x-app.player.controls.seekbar />
    <x-app.player.controls.playback />
    <x-app.player.controls.settings />
</div>
