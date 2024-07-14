{{ html()
    ->element('article')
    ->class('h-60 min-w-60 min-h-60 sm:max-h-60 sm:max-w-80')
    ->children([
        html()->a()->route('videos.view', $video)->class('relative block w-full min-w-60 h-40')->children([
            html()
                ->element('video')
                ->ignore()
                ->class('absolute inset-0 z-30 w-full h-40 rounded object-fill pointer-events-none')
                ->attributes([
                    'x-cloak',
                    'x-show' => 'show',
                    'x-ref' => 'video',
                    'x-transition',
                    'playsinline',
                    'autoplay',
                    'muted',
                ]),

            html()
                ->img($video->thumbnail, $video->title)
                ->srcset($video->srcset)
                ->loading('lazy')
                ->class('shrink-0 w-full h-40 rounded bg-black')
                ->data('manifest', $video->preview)
                ->attributes([
                    'x-data' => '{ manifest: $el.dataset.manifest }',
                    'x-on:mouseover.prevent' => 'load($refs.video, manifest)',
                    'x-on:mouseleave.outside' => 'unload()',
                    'x-on:touchstart.passive' => 'load($refs.video, manifest)',
                    'x-on:touchend.passive' => 'unload()',
                ]),
        ]),

        html()->p()->class('pt-1.5 text-center')->children([
            html()->a()->route('videos.view', $video)->text($video->title)->class('text-sm hyphens-auto line-clamp-2'),
            html()->element('dl')->class('dl dl-list justify-center text-xs text-secondary-100')
                ->childrenIf($video->duration, [
                    html()->element('dt')->text('Time')->class('sr-only'),
                    html()->element('dd')->text(duration($video->duration))
                ])
                ->childrenIf($video->identifier, [
                    html()->element('dt')->text('ID')->class('sr-only'),
                    html()->element('dd')->text($video->identifier)
                ]),
        ]),
    ])
}}
