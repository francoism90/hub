<div class="flex flex-wrap gap-x-2.5 gap-y-1">
    @foreach ($items as $item)
        <a
            class="text-sm font-medium uppercase text-primary-500 hover:text-primary-400"
            href="{{ route('videos.index', ['t' => $item->getRouteKey()]) }}">
            {{ $item->name }}
        </a>
    @endforeach
</div>
