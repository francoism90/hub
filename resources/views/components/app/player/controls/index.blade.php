@props([
    'video',
    'actions',
    'panel',
    'settings'
])

<div class="absolute z-10 inset-6">
    <x-app.player.controls.actions />
    <x-app.player.controls.details />
    <x-app.player.controls.seekbar />
    <x-app.player.controls.panel />
    <x-app.player.controls.settings />
</div>
