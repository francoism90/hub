@use('Domain\Playlists\Enums\PlaylistMixer')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->element('h1')->text('Library')->class('text-2xl') }}

    {{ html()->div()->class('flex flex-nowrap gap-2 items-center overflow-x-auto')->children($mixers, fn (PlaylistMixer $mixer) => html()
        ->button()
        ->text($mixer->label())
        ->attribute('wire:click', "setType('{$mixer->value}')")
        ->class([
            'btn btn-sm',
            'btn-primary' => $form->is('type', $mixer->value),
            'btn-secondary' => ! $form->is('type', $mixer->value),
        ])
    ) }}

    {{-- {{ html()->element('section')->attribute('wire.poll.900s', 'refresh')->class('grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
        @foreach ($this->items as $item)
            {{ html()->div()->wireKey($item->video->getRouteKey())->open() }}
                <livewire:web.videos.item :video="$item->video" :key="$item->video->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('section')->close() }} --}}

    {{-- {{ $this->items->links() }} --}}
{{ html()->div()->close() }}

<x-app.player.shim />
