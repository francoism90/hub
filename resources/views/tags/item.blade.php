<x-livewire-use::actions-link
    wire:key="item-{{ $item->getRouteKey() }}"
    class="block cursor-pointer text-sm font-medium uppercase"
    href="{{ route('home', ['t[]' => $item->getRouteKey()]) }}"
>
    <span class="text-primary-500 hover:text-primary-400">{{ $item->name }}</span>
    <span>({{ $item->videos_count }})</span>
</x-livewire-use::actions-link>
