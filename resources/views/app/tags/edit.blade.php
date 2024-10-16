@use('Domain\Tags\Models\Tag')

{{ html()->div()->class('container py-4')->children([
    html()->element('h1')->text($tag->name)->class('text-3xl hyphens-auto line-clamp-2'),
    html()->element('dl')->class('dl text-sm text-secondary-100')
        ->childrenIf($tag->type, [
            html()->element('dt')->text('ID')->class('sr-only'),
            html()->element('dd')->text($tag->type->label()),
        ])
        ->childrenIf($tag->created_at, [
            html()->element('dt')->text('ID')->class('sr-only'),
            html()->element('dd')->text($tag->created_at->format('M d, Y')),
        ])
        ->children([
            html()->element('dt')->text('Beautify')->class('sr-only'),
            html()->element('dd')->child(html()->a()->href('#')->attribute('wire:click.prevent', 'beautify')->text('Beautify 🔅'))
        ])
        ->children([
            html()->element('dt')->text('Delete')->class('sr-only'),
            html()->element('dd')->child(html()->a()->href('#')->text('Delete')->attributes([
                'wire:click.prevent' => 'delete',
                'wire:confirm' => 'Are you sure you want to delete this tag?',
            ]))
        ])
        ->children([
            html()->element('dt')->text('View')->class('sr-only'),
            html()->element('dd')->child(html()->a()->link('tags.view', $tag)->text('View')),
        ]),

    html()->wireForm($form, 'submit')->class('flex flex-col gap-y-6')->children([
        html()->div()
            ->classIf(flash()->message, ['alert mt-6', flash()->class])
            ->textIf(flash()->message, flash()->message),

        html()->div()->class('form-control')->children([
            html()->label('Name', 'form.name')->class('label'),
            html()->text()->wireModel('form.name')->placeholder('Name')->class('input'),
            html()->error('form.name'),
        ]),

        html()->div()->class('grid grid-cols-1 gap-3 sm:grid-cols-3')->child(
            html()->div()->class('form-control')->children([
                html()->label('Type')->for('form.type')->class('label'),
                html()->select(options: $types)->wireModel('form.type')->placeholder('Type')->class('select select-bordered'),
                html()->error('form.type'),
            ]),
        ),

        html()->div()->class('form-control')->attribute('x-data', '{ open: false }')->children([
            html()->label('Related')->for('form.related')->class('label'),
            html()
                ->search()
                ->id('form.related')
                ->attributes([
                    'wire:model.live.debounce' => 'related.query',
                    'x-on:click' => 'open = ! open',
                    'x-on:click.outside' => 'open = false',
                ])
                ->placeholder('Filter tags...')
                ->class('input')
                ->autocomplete('off'),

            html()->div()->class('min-h-0 flex flex-wrap items-center py-0.5 gap-1')->children($form->related, fn (array $item) => html()
                ->a()
                ->href('#')
                ->attribute('wire:click.prevent', "toggleRelated('{$item['id']}')")
                ->class('btn btn-sm btn-secondary')
                ->text($item['name'])
            ),

            html()->div()->attributes(['x-cloak', 'x-show' => 'open'])->class('relative')->child(
                html()->div()->class('absolute z-10 inset-0 input flex-wrap h-auto min-h-fit text-sm overflow-y-scroll gap-1.5 p-1.5 bg-secondary-900 text-secondary-300')
                    ->textIf($related->results()->isEmpty(), 'No tags found')
                    ->children($related->results(), fn (Tag $item) => html()
                        ->a()
                        ->href('#')
                        ->attribute('wire:click.prevent', "toggleRelated('{$item->getRouteKey()}')")
                        ->class('btn btn-sm btn-secondary')
                        ->text($item->name)
                ),
            ),
        ]),

        html()->div()->class('form-control')->children([
            html()->label('Description')->for('form.description')->class('label'),
            html()->textarea()->wireModel('form.description')->placeholder('Description')->class('textarea textarea-bordered'),
            html()->error('form.description'),
        ]),

        html()
            ->button()
            ->type('submit')
            ->text('Save Changes')
            ->class('btn btn-primary')
            ->attribute('wire:loading.attr', 'disabled')
    ])
]) }}
