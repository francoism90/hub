{{ html()->div()->attribute('x-data', 'player')->class('container py-4')->open() }}
    {{ html()->element('h1')->text('Search')->class('text-2xl') }}

    {{ html()->wireForm($form, 'submit')->class('block pt-2')->children([
        html()->input('search', name: 'form.query')->wireModel('form.query')->class('input input-bordered w-full')->placeholder('Search'),
        html()->validate('form.query'),
    ]) }}

    @if ($this->items->isNotEmpty())
        {{ html()->element('section')->wireKey($this->hash)->class('pt-4 grid grow grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4')->open() }}
            @foreach ($this->items as $video)
                <livewire:app::videos-item :$video :key="$video->getRouteKey()" />
            @endforeach
        {{ html()->element('section')->close() }}

        {{ $this->items->links() }}
    @endif
{{ html()->div()->close() }}

<x-app.player.shim />
