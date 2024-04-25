@props([
    'item',
])

<main
    wire:key="{{ $item->getRouteKey() }}"
    class="bg-black/25 h-screen w-screen max-h-[calc(100dvh-65px)]"
    @wheel.self.throttle="start"
    @touchmove.self.throttle="start"
>
    {{ $slot }}

    {{ $item->name }}
</main>
