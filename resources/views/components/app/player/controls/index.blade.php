@props([
    'video',
    'panel',
    'settings'
])

<div class="absolute z-10 inset-6">
    @if ($slot->isEmpty())
        <x-app.player.controls.details />
        <x-app.player.controls.seekbar />
        <x-app.player.controls.panel />
        <x-app.player.controls.settings />
    @else
        {{ $slot }}
    @endif
</div>
