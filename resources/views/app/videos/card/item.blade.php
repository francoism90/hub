@use('Domain\Tags\Models\Tag')

{{ html()
    ->element('article')
    ->attribute('x-data')
    ->class('w-full h-60 min-w-60 min-h-60 max-h-60')
    ->children([
        html()->a()->link('videos.view', $video)->class('relative block w-full h-48 min-h-48 max-h-48')->children([
            html()
                ->div()
                ->class('absolute inset-0 z-30 shrink-0 size-full bg-transparent')
                ->data('manifest', $video->preview)
                ->attributes([
                    'x-data' => '{ manifest: $el.dataset.manifest }',
                    'x-on:mouseover.prevent' => 'load($refs.video, manifest)',
                    'x-on:mouseleave' => 'unload()',
                    'x-on:touchstart.passive' => 'load($refs.video, manifest)',
                    'x-on:touchend.passive' => 'unload()',
                ])
                ->child(
                    html()->div()->class('absolute inset-x-1.5 bottom-1.5 flex flex-col-reverse gap-y-0.5')->children([
                        html()->element('h1')->text($video->title)->class('text-sm leading-none capitalize truncate'),
                        html()->element('dl')->class('list text-xs text-secondary-300')
                            ->childrenIf($video->duration, [
                                html()->element('dt')->text('Time')->class('sr-only'),
                                html()->element('dd')->text(duration($video->duration))
                            ])
                            ->childrenIf($video->identifier, [
                                html()->element('dt')->text('ID')->class('sr-only'),
                                html()->element('dd')->text($video->identifier)
                            ]),
                    ])
                ),

            html()
                ->img($video->thumbnail, $video->title)
                ->srcset($video->srcset)
                ->class('absolute inset-0 z-10 shrink-0 size-full rounded object-fill brightness-75')
                ->loading('lazy')
                ->crossorigin('use-credentials'),

            html()
                ->element('video')
                ->ignore()
                ->class('absolute inset-0 z-20 shrink-0 size-full rounded object-fill brightness-90')
                ->attributes([
                    'x-cloak',
                    'x-ref' => 'video',
                    'x-show' => 'show',
                    'x-transition.opacity',
                    'playsinline',
                    'autoplay',
                    'muted',
                ]),
        ]),

        html()->div()->class('py-1.5 dl justify-center')->children($video->tags->take(3), fn (Tag $tag) =>
            html()
                ->a()
                ->link('tags.view', $tag)
                ->text($tag->name)
                ->class('text-sm text-secondary-400')
        ),
    ])
}}
