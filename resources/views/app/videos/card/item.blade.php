{{ html()
    ->element('article')
    ->class('w-80 h-60 max-w-80 max-h-60 flex flex-col gap-y-1')
    ->wireKey($video->getRouteKey())
    ->children([
        html()->a()->navigate()->class('relative w-80 h-40')->children([
            html()
                ->element('video')
                ->class('absolute inset-0 z-30 w-80 h-40 rounded object-fill pointer-events-none')
                ->attributes([
                    'x-cloak',
                    'x-show' => 'show',
                    'x-ref' => 'video',
                    'x-transition',
                    'autoplay',
                    'muted',
                ]),

            html()
                ->img($video->thumbnail, $video->title)
                ->class('shrink-0 w-80 h-40 rounded bg-black')
                ->data('manifest', $video->preview)
                ->attributes([
                    'x-data' => '{ manifest: $el.dataset.manifest }',
                    'x-on:mouseover.prevent' => 'load($refs.video, manifest)',
                    'x-on:mouseleave.outside' => 'unload()',
                    'x-on:touchstart.passive' => 'load($refs.video, manifest)',
                    'x-on:touchend.passive' => 'unload()',
                ]),
        ]),

        html()->p()->class('text-center')->children([
            html()->a()->text($video->title)->class('text-sm line-clamp-2'),
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
