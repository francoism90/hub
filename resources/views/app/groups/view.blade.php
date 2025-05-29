@use('Domain\Groups\Enums\GroupSet')
@use('Domain\Tags\Models\Tag')
@use('Illuminate\Support\Number')

{{ html()->div()->attribute('x-data', 'preview')->class('container py-4 flex flex-col gap-y-3')->open() }}
    {{ html()->element('section')->children([
        html()->element('h1')->text($title)->class('text-3xl hyphens-auto line-clamp-2'),
        html()->element('dl')->class('dl text-sm text-secondary-100')
            ->childrenIf($group->user_id, [
                html()->element('dt')->text('Creator')->class('sr-only'),
                html()->element('dd')->text($group->user->name ?? 'Unknown'),
            ])
            ->childrenIf($group->videos()->exists(), [
                html()->element('dt')->text('Clear Items')->class('sr-only'),
                html()->element('dd')->child(html()->a()->href('#')->text('Clear')->attributes([
                    'wire:click.prevent' => 'clear',
                    'wire:confirm' => 'Are you sure you want to delete all the items of this playlist?',
                ]))
            ])
            ->childrenIf(! $group->isReserved(), [
                html()->element('dt')->text('Delete Playlist')->class('sr-only'),
                html()->element('dd')->child(html()->a()->href('#')->text('Delete')->attributes([
                    'wire:click.prevent' => 'delete',
                    'wire:confirm' => 'Are you sure you want to delete this playlist?',
                ]))
            ])
    ]) }}

    {{ html()->div()->class('flex flex-nowrap gap-2 items-center py-1.5 overflow-x-auto *:shrink-0')->children($types, fn (GroupSet $type) => html()->div()->wireKey("filter-{$type->value}")->children([
        html()
            ->radio('type')
            ->wireModel('form.type', 'live')
            ->value($type->value)
            ->id("filter-{$type->value}")
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
        ->attribute('wire:poll.600s')
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
