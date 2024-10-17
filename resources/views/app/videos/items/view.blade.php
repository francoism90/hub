{{ html()->div()->attribute('x-data', 'preview')->open() }}
    {{ html()
        ->element('main')
        ->attribute('wire.poll.900s', 'refresh')
        ->class('grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')
        ->open()
    }}
        @foreach ($this->items as $item)
            {{ html()->div()->wireKey($item->getRouteKey())->open() }}
                <livewire:web.videos.item :video="$item" :key="$item->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('main')->close() }}

    {{ html()->element('nav')->class('w-full flex flex-nowrap items-center justify-center')->open() }}
        @if ($this->hasMorePages())
            {{ html()->div()->attribute('x-intersect.full', '$wire.fetch()') }}
        @endif
    {{ html()->element('nav')->close() }}
{{ html()->div()->close() }}
