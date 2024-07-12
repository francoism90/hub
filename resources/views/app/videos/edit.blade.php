{{ html()->div()->class('container py-4')->children([
    html()->element('h1')->text($video->title)->class('text-3xl hyphens-auto line-clamp-2'),
    html()->element('dl')->class('dl dl-list text-sm text-secondary-100')
        ->childrenIf($video->duration, [
            html()->element('dt')->text('Time')->class('sr-only'),
            html()->element('dd')->text(duration($video->duration)),
        ])
        ->childrenIf($video->identifier, [
            html()->element('dt')->text('ID')->class('sr-only'),
            html()->element('dd')->text($video->identifier),
        ])
        ->childrenIf($video->created_at, [
            html()->element('dt')->text('ID')->class('sr-only'),
            html()->element('dd')->text($video->created_at->format('M d, Y')),
        ])
        ->children([
            html()->element('dt')->text('Beautify')->class('sr-only'),
            html()->element('dd')->child(html()->a()->href('#')->attribute('wire:click.prevent', 'beautify')->text('Beautify 🔅'))
        ])
        ->children([
            html()->element('dt')->text('Delete')->class('sr-only'),
            html()->element('dd')->child(html()->a()->href('#')->text('Delete')->attributes([
                'wire:click.prevent' => 'delete',
                'wire:confirm' => 'Are you sure you want to delete this video?',
            ]))
        ])
        ->children([
            html()->element('dt')->text('View')->class('sr-only'),
            html()->element('dd')->child(html()->a()->route('videos.view', $video)->text('View')),
        ]),

    html()->wireForm($form, 'submit')->class('flex flex-col py-6 gap-y-6')->children([
        html()->div()
            ->classIf(flash()->message, 'form-message')
            ->textIf(flash()->message, flash()->message),

        html()->div()->class('form-control')->children([
            html()->label('Name', 'form.name')->class('label'),
            html()->text()->wireModel('form.name')->placeholder('Name')->class('input input-bordered'),
            html()->validate('form.name'),
        ]),

        html()->div()->class('grid grid-cols-1 gap-3 sm:grid-cols-3')->children([
            html()->div()->class('form-control')->children([
                html()->label('Episode')->for('form.episode')->class('label'),
                html()->text()->wireModel('form.episode')->placeholder('E01')->class('input input-bordered'),
                html()->validate('form.episode'),
            ]),

            html()->div()->class('form-control')->children([
                html()->label('Season')->for('form.season')->class('label'),
                html()->text()->wireModel('form.season')->placeholder('S01')->class('input input-bordered'),
                html()->validate('form.season'),
            ]),

            html()->div()->class('form-control')->children([
                html()->label('Part')->for('form.part')->class('label'),
                html()->text()->wireModel('form.part')->placeholder('1')->class('input input-bordered'),
                html()->validate('form.part'),
            ]),
        ]),

        html()->div()->class('grid grid-cols-1 gap-3 sm:grid-cols-2')->children([
            html()->div()->class('form-control')->children([
                html()->label('Released At')->for('form.released_at')->class('label'),
                html()->date()->wireModel('form.released_at')->class('input input-bordered'),
                html()->validate('form.released_at'),
            ]),

            html()->div()->class('form-control')->children([
                html()->label('Snapshot')->for('form.snapshot')->class('label'),
                html()->text()->wireModel('form.snapshot')->placeholder('1.0')->class('input input-bordered'),
                html()->validate('form.snapshot'),
            ]),
        ]),

        html()->div()->class('form-control')->attribute('x-data', '{ open: false }')->children([
            html()->label('Tags')->for('form.tags')->class('label'),
            html()
                ->search()
                ->attributes([
                    'wire:model.live.debounce' => 'tags.query',
                    'x-on:click' => 'open = ! open',
                    'x-on:click.outside' => 'open = false',
                ])
                ->placeholder('Filter tags...')
                ->class('input input-bordered')
                ->autocomplete('off'),
            html()->div()->class('flex flex-wrap items-center py-0.5 gap-1')->children($form->tags, fn ($item) => html()
                ->a()
                ->href('#')
                ->attribute('wire:click.prevent', "toggleTag('{$item['id']}')")
                ->class('btn btn-secondary text-sm px-2 py-1')
                ->text($item['name'])
            ),
            html()->div()->attributes(['x-cloak', 'x-show' => 'open'])->class('relative')->child(
                html()->div()->class('absolute inset-0 grid grid-cols-1 divide-y divide-secondary-400/50')->children($tags->results(), fn ($item) => html()
                    ->a()
                    ->href('#')
                    ->attribute('wire:click.prevent', "toggleTag('{$item->getRouteKey()}')")
                    ->class('py-1 px-3 bg-secondary-500 hover:bg-secondary-600')
                    ->text($item->name)
                ),
            ),
        ]),

        html()->button()->text('Save Changes')->class('btn btn-secondary')
    ])
]) }}
