@props([
    'item',
])

<article
    wire:key="item-{{ $item->getRouteKey() }}"
    class="flex flex-col flex-nowrap h-56 w-full gap-x-4 rounded border border-secondary-700/30 bg-secondary-900/75"
>
    <x-dashboard.videos.content.preview />

    {{ $item->name }}
</article>
