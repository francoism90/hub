@use('Domain\Groups\Enums\GroupCategory')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto')->children($categories, fn (GroupCategory $category) => html()->div()->children([
        html()
            ->radio('type')
            ->id($category->value)
            ->value($category->value)
            ->wireModel('form.type', 'live')
            ->class('hidden'),

        html()
            ->label()
            ->for($category->value)
            ->text($category->label())
            ->class([
                'btn btn-sm',
                'btn-primary' => $form->is('type', $category->value),
                'btn-secondary' => ! $form->is('type', $category->value),
            ])
        ])
    ) }}

    {{ html()->element('section')->attribute('x-data', 'preview')->class('py-3')->open() }}
        {{ html()->div()->wireKey($form->type)->open() }}
            <livewire:web.library.feed :key="$form->type" :$form />
        {{ html()->div()->close() }}
    {{ html()->element('section')->close() }}
{{ html()->div()->close() }}

<x-app.player.shim />
