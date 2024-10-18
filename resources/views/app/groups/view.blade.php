@use('Domain\Groups\Enums\GroupSet')
@use('Domain\Tags\Models\Tag')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->element('section')->children([
        html()->element('h1')->text($title)->class('text-2xl'),
    ]) }}

    {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto *:shrink-0')->children($types, fn (GroupSet $type) => html()->div()->wireKey("filter-{$type->value}")->children([
        html()
            ->radio('type')
            ->id("filter-{$type->value}")
            ->value($type->value)
            ->wireModel('form.type', 'live')
            ->class('hidden'),

        html()
            ->label()
            ->for("filter-{$type->value}")
            ->text($type->label())
            ->class([
                'btn btn-sm',
                'btn-primary' => $form->is('type', $type->value),
                'btn-secondary' => ! $form->is('type', $type->value),
            ])
        ])
    ) }}

    {{ html()
        ->element('main')
        ->attribute('wire:poll.900s')
        ->class('grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')
        ->open()
    }}
        @foreach ($this->items as $item)
            {{ html()->div()->wireKey($item->getRouteKey())->open() }}
                <livewire:web.videos.item :video="$item" :key="$item->getRouteKey()" />
            {{ html()->div()->close() }}
        @endforeach
    {{ html()->element('main')->close() }}

    {{ $this->items->links() }}
{{ html()->div()->close() }}

<x-app.player.shim />
