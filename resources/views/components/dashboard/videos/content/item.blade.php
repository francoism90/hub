@props([
    'item',
])

<article
    wire:key="item-{{ $item->getRouteKey() }}"
    class="flex flex-col flex-nowrap gap-x-4 rounded border border-gray-700/30 bg-gray-900/75">
>

    {{ $item->name }}
</article>
