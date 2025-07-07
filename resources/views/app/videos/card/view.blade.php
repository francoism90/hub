@use('Domain\Tags\Models\Tag')

{{ html()
    ->element('article')
    ->id('item-' . $video->getRouteKey())
    ->class('card w-full h-60 min-w-60 min-h-60 max-h-60')
    ->data('manifest', $video->preview)
    ->attributes([
        'x-data' => '{ shown: false, manifest: $el.dataset.manifest }',
        'x-intersect' => 'shown = true',
    ])
    ->children([
        html()
            ->a()
            ->link('videos.view', $video)
            ->class('relative z-0 shrink-0 block w-full h-48 min-h-48 max-h-48')
            ->attributes([
                'x-cloak',
                'x-show' => 'shown',
                'x-on:mouseenter.prevent' => 'load($refs.video, manifest)',
                'x-on:mouseleave.prevent' => 'unload()',
                'x-on:touchstart.passive' => 'load($refs.video, manifest)',
                'x-on:touchend.passive' => 'unload()',
            ])
            ->children([
                html()
                    ->img($video->thumbnail, $video->title)
                    ->class('absolute inset-0 z-0 w-full h-48 min-h-48 max-h-48 rounded object-fill brightness-85')
                    ->srcset($video->srcset)
                    ->loading('lazy')
                    ->crossorigin('use-credentials')
                    ->attributes([
                        'x-cloak',
                        'x-show' => 'shown',
                        'sizes' => '(min-width: 768px) 768px, 320px)',
                    ]),

                html()
                    ->element('video')
                    ->class('absolute inset-0 z-10 w-full h-48 min-h-48 max-h-48 rounded object-fill brightness-95')
                    ->attributes([
                        'x-cloak',
                        'x-ref' => 'video',
                        'x-show' => 'shown && ready',
                        'x-transition.opacity',
                        'playsinline',
                        'autoplay',
                        'muted',
                        'loop',
                    ]),

                html()->div()->class('absolute z-30 inset-x-1.5 bottom-1.5 flex flex-col-reverse gap-y-0.5')->children([
                    html()->element('h1')->text($video->title)->class('text-sm leading-none capitalize truncate'),

                    html()->element('dl')->class('list text-xs text-secondary-300')
                        ->childrenIf($video->duration, [
                            html()->element('dt')->text('Time')->class('sr-only'),
                            html()->element('dd')->text($video->timestamp)
                        ])
                        ->childrenIf($video->identifier, [
                            html()->element('dt')->text('ID')->class('sr-only'),
                            html()->element('dd')->text($video->identifier)
                        ])
                        ->childrenIf($video->caption, [
                            html()->element('dt')->text('Caption')->class('sr-only'),
                            html()->element('dd')->text('CC')
                        ]),
                ])
            ]),

        html()->div()->class('card-body py-1.5 dl justify-center')->children($video->tags->take(3), fn (Tag $tag) => html()
            ->a()
            ->link('tags.view', $tag)
            ->text($tag->name)
            ->class('text-sm text-secondary-400')
        ),
    ])
}}
