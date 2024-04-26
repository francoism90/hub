<x-wireui::actions-link
    wire:key="item-{{ $item->getRouteKey() }}"
    class="block cursor-pointer text-sm font-medium uppercase"
    {{-- href="{{ route('tags.view', $item) }}" --}}
>
    <span class="text-primary-500 hover:text-primary-400">{{ $item->name }}</span>
    <span>({{ $item->videos_count }})</span>
</x-wireui::actions-link>
