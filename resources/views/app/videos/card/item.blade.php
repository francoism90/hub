{{ html()
    ->element('article')
    ->attribute('x-data', '{ preview: false }')
    ->class('flex flex-col gap-y-1')
    ->wireKey($video->getRouteKey())
    ->children([
        html()->a()->navigate()->class('relative w-80 h-40 min-h-40 min-w-80')->children([
            html()
                ->element('video')
                ->class('absolute inset-0 z-30 w-80 h-40 rounded object-fill')
                ->attributes([
                    'x-cloak',
                    'x-ref' => 'video',
                    'x-show' => 'preview',
                ]),

            html()
                ->img($video->thumbnail, $video->title)
                ->class('shrink-0 w-80 h-40 rounded bg-black')
                ->attributes([
                    'x-on:mouseover' => 'preview = true',
                    'x-on:mouseleave' => 'preview = false',
                ]),
        ]),

        html()->p()->class('text-center')->children([
            html()->a()->text($video->title)->class('text-sm'),
            html()->element('dl')->class('dl dl-list justify-center text-xs text-secondary-100')
                ->childrenIf($video->duration, [
                    html()->element('dt')->text('Duration')->class('sr-only'),
                    html()->element('dd')->text(duration($video->duration))
                ])
                ->childrenIf($video->identifier, [
                    html()->element('dt')->text('ID')->class('sr-only'),
                    html()->element('dd')->text($video->identifier)
                ]),
        ]),
    ])
}}

