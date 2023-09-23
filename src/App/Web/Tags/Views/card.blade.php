<a
    wire:key="{{ $item->getRouteKey() }}"
    class="cursor-pointer text-sm font-medium uppercase"
    href="{{ route('videos.index', ['t[]' => $item->getRouteKey()]) }}">
    <span class="text-primary-500 hover:text-primary-400">{{ $item->name }}</span>
    <span>({{ $item->videos_count }})</span>
</a>
