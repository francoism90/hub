@props([
    'video',
])

<div class="relative h-full w-full">
    <x-app.videos.player :$video>
        <x-app.videos.player.seek />
    </x-app.videos.player>
</div>
