@use('Domain\Tags\Models\Tag')
@use('Illuminate\Support\Number')

{{ html()->div()->class('container py-4')->children([
    html()->element('h1')->text($video->title)->class('text-3xl hyphens-auto line-clamp-2'),
    html()->element('dl')->class('dl text-sm text-gray-100')
        ->childrenIf($video->created_at, [
            html()->element('dt')->text('Added')->class('sr-only'),
            html()->element('dd')->text($video->created_at->format('M d, Y')),
        ])
        ->childrenIf($video->file_size, [
            html()->element('dt')->text('Filesize')->class('sr-only'),
            html()->element('dd')->text(Number::fileSize($video->file_size)),
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
            html()->element('dt')->text('Download')->class('sr-only'),
            html()->element('dd')->child(html()->a()->href($video->download)->text('Download'))
        ])
        ->children([
            html()->element('dt')->text('View')->class('sr-only'),
            html()->element('dd')->child(html()->a()->link('videos.view', $video, modifiers: 'exact')->text('View')),
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

        html()->div()->class('grid grid-cols-1 gap-3 sm:grid-cols-3')->children([
            html()->div()->class('form-control')->children([
                html()->label('Episode')->for('form.episode')->class('label'),
                html()->text()->wireModel('form.episode')->placeholder('E01')->class('input'),
                html()->error('form.episode'),
            ]),

            html()->div()->class('form-control')->children([
                html()->label('Season')->for('form.season')->class('label'),
                html()->text()->wireModel('form.season')->placeholder('S01')->class('input'),
                html()->error('form.season'),
            ]),

            html()->div()->class('form-control')->children([
                html()->label('Scene')->for('form.part')->class('label'),
                html()->text()->wireModel('form.part')->placeholder('1')->class('input'),
                html()->error('form.part'),
            ]),
        ]),

        html()->div()->class('grid grid-cols-1 gap-3 sm:grid-cols-2')->children([
            html()->div()->class('form-control')->children([
                html()->label('Released At')->for('form.released_at')->class('label'),
                html()->date()->wireModel('form.released_at')->class('input'),
                html()->error('form.released_at'),
            ]),

            html()->div()->class('form-control')->children([
                html()->label('Snapshot')->for('form.snapshot')->class('label'),
                html()->text()->wireModel('form.snapshot')->placeholder('1.0')->class('input'),
                html()->error('form.snapshot'),
            ]),
        ]),

        html()->div()->class('form-control')->attribute('x-data', '{ open: false }')->children([
            html()->label('Tags')->for('form.tags')->class('label'),
            html()
                ->search()
                ->id('form.tags')
                ->attributes([
                    'wire:model.live.debounce' => 'tags.query',
                    'x-on:click' => 'open = ! open',
                    'x-on:click.outside' => 'open = false',
                ])
                ->placeholder('Filter tags...')
                ->class('input')
                ->autocomplete('off'),

            html()->div()->class('min-h-0 flex flex-wrap items-center py-0.5 gap-1.5')->children($form->tags, fn (array $item) => html()
                ->a()
                ->href('#')
                ->attribute('wire:click.prevent', "toggleTag('{$item['id']}')")
                ->class('btn btn-sm btn-secondary')
                ->text($item['name'])
            ),

            html()->div()->attributes(['x-cloak', 'x-show' => 'open'])->class('relative')->child(
                html()->div()->class('absolute z-10 inset-0 input flex-wrap h-auto min-h-fit text-sm overflow-y-scroll gap-1.5 p-1.5 bg-gray-900 text-gray-300')
                    ->textIf($tags->results()->isEmpty(), 'No tags found')
                    ->children($tags->results(), fn (Tag $item) => html()
                        ->a()
                        ->href('#')
                        ->attribute('wire:click.prevent', "toggleTag('{$item->getRouteKey()}')")
                        ->class('btn btn-sm btn-secondary')
                        ->text($item->name)
                ),
            ),
        ]),

         html()->div()->class('grid grid-cols-1 gap-3')->children([
            html()->div()->class('form-control')->children([
                html()->label('Summary')->for('form.summary')->class('label'),
                html()->textarea()->wireModel('form.summary')->class('textarea'),
                html()->error('form.summary'),
            ]),
        ]),

        html()
            ->button()
            ->type('submit')
            ->text('Save Changes')
            ->class('btn btn-primary')
            ->attribute('wire:loading.attr', 'disabled'),
    ])
]) }}
