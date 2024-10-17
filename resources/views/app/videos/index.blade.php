@use('Domain\Groups\Models\Group')

{{ html()->div()->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto *:shrink-0')
        ->child(html()->button()->attribute('wire:click', 'mix')->class('btn btn-sm btn-outlined')->child(html()->icon()->svg('heroicon-s-arrow-path', 'size-4 text-white')))
        ->children($this->items, fn (Group $item) => html()->div()->wireKey("filter-{$item->getRouteKey()}")->children([
            html()
                ->radio('form.group')
                ->id("select-{$item->getRouteKey()}")
                ->value($item->getRouteKey())
                ->wireModel('form.group', 'live')
                ->class('hidden'),

            html()
                ->label()
                ->for("select-{$item->getRouteKey()}")
                ->text($item->name)
                ->class([
                    'btn btn-sm',
                    'btn-primary' => $form->is('group', $item->getRouteKey()),
                    'btn-secondary' => ! $form->is('group', $item->getRouteKey()),
                ])
            ])
    ) }}

    @if ($group)
        <livewire:web.videos.items :key="$group->getRouteKey()" :$form :$group />
    @endif
{{ html()->div()->close() }}

<x-app.player.shim />
