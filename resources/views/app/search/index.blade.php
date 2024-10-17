{{ html()->div()->attribute('x-data', 'preview')->class('container py-4')->open() }}
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
        {{ html()->element('main')->attribute('wire:poll.900s')->class('pt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
            @foreach ($this->items as $video)
                {{ html()->div()->wireKey($video->getRouteKey())->open() }}
                    <livewire:web.videos.item :$video :key="$video->getRouteKey()" lazy />
                {{ html()->div()->close() }}
            @endforeach
        {{ html()->element('main')->close() }}

        {{ html()->element('nav')->class('w-full flex flex-nowrap items-center justify-center')->open() }}
            @if ($this->hasMorePages())
                {{ html()->div()->attribute('x-intersect', '$wire.fetch()') }}
            @endif
        {{ html()->element('nav')->close() }}
    @elseif ($form->query() && ! $this->hasResults())
        {{ html()->div()->class('py-4 text-center text-secondary-300')->text('No results found.') }}
    @endif
{{ html()->div()->close() }}

<x-app.player.shim />
