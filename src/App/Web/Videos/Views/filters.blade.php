<div {{ $attributes->class('flex flex-wrap gap-x-2.5 gap-y-1 text-sm font-medium') }}>
    @foreach ($items as $item)
        <a
            class="uppercase text-primary-500 hover:text-primary-400"
            href="{{ route('videos.index', ['tag' => $item->getRouteKey()]) }}">
            {{ $item->name }}
        </a>
    @endforeach
</div>
