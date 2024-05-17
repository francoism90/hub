@props([
    'item',
])

<a
    wire:key="taggable-{{ $item->getRouteKey() }}"
    wire:navigate
    href="{{ route('tags.view', $item) }}"
    class="block cursor-pointer text-sm font-medium uppercase"
>
    <span class="text-primary-500 hover:text-primary-400">{{ $item->name }}</span>
    <span>({{ $item->videos_count }})</span>
</a>
