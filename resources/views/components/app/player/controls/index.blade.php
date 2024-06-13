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
    class="absolute inset-0 z-10 select-none"
>
    <x-app.player.controls.navigation />
    <x-app.player.controls.details />
    <x-app.player.controls.seekbar />
    <x-app.player.controls.playback />
    <x-app.player.controls.settings />
    <x-app.player.controls.dialog />
</div>
