{{ html()->div()->attribute('x-data', 'player')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->element('h1')->text('Library')->class('text-2xl') }}

    {{ html()->div()->class('flex flex-nowrap gap-2 items-center overflow-x-auto')->children($types, fn (array $item) => html()
        ->a()
        ->href('#')
        ->text($item['label'])
        ->attribute('wire:click', "setType('{$item['key']}')")
        ->class([
            'btn font-medium text-sm px-2 py-1',
            'btn-secondary' => ! $form->is('type', $item['key']),
            'btn-primary' => $form->is('type', $item['key']),
        ])
    ) }}

    {{ html()->element('section')->attribute('wire.poll.300s', 'refresh')->class('grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
        @foreach ($this->items as $video)
            {{ html()->div()->wireKey($video->getRouteKey())->class('snap-start scroll-mx-6 shrink-0 sm:max-w-80')->open() }}
                <livewire:web.videos.item :$video :key="$video->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('section')->close() }}

    {{ $this->items->links() }}
{{ html()->div()->close() }}

<x-app.player.shim />
