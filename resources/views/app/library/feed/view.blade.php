{{ html()
    ->element('section')
    ->attributes([
        'x-data' => '',
        'wire.poll.900s' => 'refresh',
    ])
    ->class('grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')
    ->open()
}}
    @foreach ($this->items as $item)
        {{ html()->div()->wireKey($item->getRouteKey())->open() }}
            <livewire:web.videos.item :video="$item" :key="$item->getRouteKey()" />
        {{ html()->div()->close() }}
    @endforeach

    @if ($this->hasMorePages())
        {{ html()->div()->class('self-center loading loading-spinner')->attribute('x-intersect', '$wire.fetch()') }}
    @endif
{{ html()->element('section')->close() }}
