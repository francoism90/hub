{{ html()->div()->attribute('x-data', 'player')->class('container py-4')->open() }}
    {{ html()->element('h1')->text('Search')->class('text-2xl') }}

    {{ html()->wireForm($form, 'submit')->class('block pt-2')->children([
        html()->search()->wireModel('form.query')->autofocus()->class('input input-md input-rounded bg-secondary-500/25')->placeholder('Title, description, or tags'),
        html()->error('form.query'),
    ]) }}

    @if (! $form->query() || ! $this->hasResults())
        {{ html()->div()->class('flex flex-wrap items-center text-sm py-1.5 gap-1')
            ->child(html()->span()->class('text-secondary-300')->text('Hint:')
            ->children($suggestions, fn (string $item) => html()
                ->a()
                ->href('#')
                ->attribute('wire:click.prevent', "setQuery('{$item}')")
                ->class('link link-secondary px-1 text-sm')
                ->text($item)
            )
        ) }}
    @endif

    @if ($this->hasResults())
        {{ html()->element('section')->attribute('wire.poll.900s', 'refresh')->class('pt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
            @foreach ($this->items as $video)
                {{ html()->div()->wireKey($video->getRouteKey())->open() }}
                    <livewire:web.videos.item :$video :key="$video->getRouteKey()" />
                {{ html()->div()->close() }}
            @endforeach
        {{ html()->element('section')->close() }}

        {{ $this->items->links() }}
    @elseif ($form->query() && ! $this->hasResults())
        {{ html()->div()->class('text-center text-secondary-300 py-4')->text('No results found.') }}
    @endif
{{ html()->div()->close() }}

<x-app.player.shim />
