{{ html()->div()->open() }}
    {{ html()->div()->class('relative h-80 min-h-80 max-h-96 w-full bg-black sm:h-[32rem] sm:min-h-[32rem] sm:max-h-[32rem]')->open() }}
        <livewire:web.videos.player :$video />
    {{ html()->div()->close() }}

    {{ html()->element('nav')->class('container py-3')->children([
        html()->element('h1')->text($video->title)->class('text-2xl capitalize line-clamp-2'),
        html()->element('dl')->class('dl text-sm text-secondary-100')
            ->childrenIf($video->duration, [
                html()->element('dt')->text('Time')->class('sr-only'),
                html()->element('dd')->text($video->timestamp),
            ])
            ->childrenIf($video->identifier, [
                html()->element('dt')->text('ID')->class('sr-only'),
                html()->element('dd')->text($video->identifier),
            ])
            ->childrenIf($video->published, [
                html()->element('dt')->text('Published')->class('sr-only'),
                html()->element('dd')->text($video->published->format('M d, Y')),
            ])
            ->childrenIf(auth()->user()->can('update', $video), [
                html()->element('dt')->text('Manage')->class('sr-only'),
                html()->element('dd')->child(html()->a()->link('videos.edit', $video)->text('Edit')),
            ])
    ]) }}

    {{ html()->element('nav')->class('container py-1 flex flex-nowrap gap-2')->children([
        html()->button()->class('btn btn-inline')->attributes(['wire:click' => 'toggleFavorite', 'wire:loading.attr' => 'disabled'])->child(
            html()->icon()->svg($this->isFavorited ? 'heroicon-s-heart' : 'heroicon-o-heart', 'size-6 text-inherit')
        ),

        html()->button()->class('btn btn-inline')->attributes(['wire:click' => 'toggleSave', 'wire:loading.attr' => 'disabled'])->child(
            html()->icon()->svg($this->isSaved ? 'heroicon-s-clock' : 'heroicon-o-clock', 'size-6 text-inherit')
        ),
    ]) }}

    @if ($video->tags()->exists())
        {{ html()->div()->class('container py-3 flex flex-wrap gap-2')->open() }}
            @foreach ($video->tags as $tag)
                {{ html()->div()->wireKey($tag->getRouteKey())->child(
                    html()->a()->link('tags.view', $tag)->class('btn btn-md btn-secondary font-normal')->text($tag->name)
                ) }}
            @endforeach
        {{ html()->div()->close() }}
    @endif

    {{ html()->element('section')->attribute('x-data', 'preview')->class('py-3')->open() }}
        <livewire:web.videos.next :$video lazy />
        <livewire:web.videos.random :$video lazy />
    {{ html()->element('section')->close() }}
{{ html()->div()->close() }}

<x-app.player.shim />
