@use('Domain\Groups\Models\Group')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto *:shrink-0')->children($this->items, fn (Group $item) => html()->div()->children([
        html()
            ->radio('form.group')
            ->id("filter-{$item->getRouteKey()}")
            ->value($item->getRouteKey())
            ->wireModel('form.group', 'live')
            ->class('hidden'),

        html()
            ->label()
            ->for("filter-{$item->getRouteKey()}")
            ->text($item->name)
            ->class([
                'btn btn-sm',
                'btn-primary' => $form->is('group', $item->getRouteKey()),
                'btn-secondary' => ! $form->is('group', $item->getRouteKey()),
            ])
        ])
    ) }}

    @if ($group instanceof Group)
        {{ html()->element('section')->open() }}
            {{ html()->div()->wireKey($group->getRouteKey())->open() }}
                <livewire:web.videos.items :key="$group->getRouteKey()" :$form :$group />
            {{ html()->div()->close() }}
        {{ html()->element('section')->close() }}
    @endif
{{ html()->div()->close() }}

<x-app.player.shim />
