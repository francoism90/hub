{{ html()->div()->open() }}
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
    {{ html()->element('section')->close() }}

    @if ($this->hasMorePages())
        {{ html()->element('nav')->class('w-full flex min-h-0 py-2 flex-nowrap items-center justify-center')->attribute('x-intersect', '$wire.fetch()')->child(html()
            ->button(__('Processing...'))
            ->class('hidden')
        ) }}
    @endif

    @if ($this->onLastPage())
        {{ html()->element('nav')->class('w-full flex py-2 flex-nowrap items-center justify-center')->child(html()
            ->button(__('Refresh'))
            ->attribute('wire:click', 'regenerate')
            ->class('btn btn-secondary btn-outlined')
        ) }}
    @endif
{{ html()->div()->close() }}
