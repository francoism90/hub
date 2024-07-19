{{ html()->div()->open() }}
    {{ html()->div()->class('relative h-80 min-h-80 max-h-96 w-full bg-black sm:h-[32rem] sm:min-h-[32rem] sm:max-h-[32rem]')->open() }}
        <livewire:app::videos-player :$video />
    {{ html()->div()->close() }}

    {{ html()->div()->class('container py-4')->children([
        html()->element('h1')->text($video->title)->class('text-2xl hyphens-auto line-clamp-2'),
        html()->element('dl')->class('dl dl-list text-sm text-secondary-100')
            ->childrenIf($video->duration, [
                html()->element('dt')->text('Filesize')->class('sr-only'),
                html()->element('dd')->text(duration($video->duration)),
            ])
            ->childrenIf($video->identifier, [
                html()->element('dt')->text('ID')->class('sr-only'),
                html()->element('dd')->text($video->identifier),
            ])
            ->childrenIf($video->published, [
                html()->element('dt')->text('ID')->class('sr-only'),
                html()->element('dd')->text($video->published->format('M d, Y')),
            ])
            ->childrenIf(auth()->user()->can('update', $video), [
                html()->element('dt')->text('ID')->class('sr-only'),
                html()->element('dd')->child(html()->a()->link('account.videos.edit', $video)->text('Edit')),
            ])
    ]) }}

    @if ($video->tags()->count())
        {{ html()->div()->class('container py-2 flex flex-wrap gap-2')->open() }}
            @foreach ($video->tags as $tag)
                {{ html()->div()->wireKey($tag->getRouteKey())->child(
                    html()->a()->link('tags.view', $tag)->class('btn btn-secondary px-3 py-1.5 rounded')->text($tag->name)
                ) }}
            @endforeach
        {{ html()->div()->close() }}
    @endif

    {{ html()->element('section')->attribute('x-data', 'player')->class('py-6')->open() }}
        <livewire:app::videos-next :$video lazy />
        <livewire:app::videos-recommended :$video lazy />
    {{ html()->element('section')->close() }}
{{ html()->div()->close() }}

<x-app.player.shim />
