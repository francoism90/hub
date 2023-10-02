<div {{ $attributes->class('flex flex-wrap gap-x-2.5 gap-y-1 text-sm') }}>
    @foreach ($items as $item)
        <a
            class="font-medium uppercase tracking-tight text-primary-500 hover:text-primary-400"
            href="{{ route('videos.index', ['t[]' => $item->getRouteKey()]) }}"
            aria-label="{{ $item->name }}"
            title="{{ $item->name }}"
            wire:navigate>
            {{ $item->name }}
        </a>
    @endforeach
</div>
