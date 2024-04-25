@props([
    'video',
])

<main
    wire:key="{{ $video->getRouteKey() }}"
    class="bg-black/25 h-screen w-screen max-h-[calc(100dvh-65px)]"
    @wheel.self.throttle="start"
    @touchmove.self.throttle="start"
>
    {{ $slot }}

    {{ $video->name }}
</main>
