{{ html()->div()->open() }}
    {{ html()->div()->class('relative h-80 min-h-80 max-h-96 w-full bg-black sm:h-[32rem] sm:min-h-[32rem] sm:max-h-[32rem]')->open() }}
        <livewire:app::videos-player :$video />
    {{ html()->div()->close() }}

    {{ html()->div()->class('container py-4')->children([
        html()->element('h1')->text($video->title)->class('text-2xl line-clamp-2'),
        html()->element('dl')->class('dl dl-list text-sm text-secondary-100')
            ->childrenIf($video->duration, [
                html()->element('dt')->text('Time')->class('sr-only'),
                html()->element('dd')->text(duration($video->duration))
            ])
            ->childrenIf($video->identifier, [
                html()->element('dt')->text('ID')->class('sr-only'),
                html()->element('dd')->text($video->identifier)
            ]),
    ]) }}
{{ html()->div()->close() }}
