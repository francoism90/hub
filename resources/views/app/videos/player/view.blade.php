{{ html()
    ->element('main')
    ->ignore()
    ->class('relative size-full bg-black')
    ->attributes([
        'x-data' => "play('{$manifest}', {$startsAt})",
        'x-cloak',
        'x-ref' => 'container',
        'x-show' => 'ready',
        'x-transition.opacity',
        'x-on:click' => 'showOverlay',
        'x-on:mousemove' => 'showOverlay',
        'x-on:touchmove' => 'showOverlay',
    ])
    ->children([
        html()
            ->element('video')
            ->class('absolute z-0 inset-0 size-full bg-black')
            ->attributes([
                'x-ref' => 'video',
                'x-on:timeupdate.throttle.2500ms' => 'sync',
                'playsinline',
                'autoplay',
            ]),

        html()->div()->class('absolute z-10 inset-0 size-full')->children([
            html()->div()->class('size-full grid grid-cols-2 gap-x-4')->children([
                html()->div()->attribute('x-on:dblclick.debounce', 'backward'),
                html()->div()->attribute('x-on:dblclick.debounce', 'forward'),
            ]),

            html()->div()->attributes(['x-cloak', 'x-show' => 'overlay', 'x-transition.opacity'])->class('absolute z-20 bottom-3 inset-x-4')->child(
                html()->div()->class('flex flex-col flex-nowrap gap-y-3')->children([
                    html()->div()->class('relative h-1.5 w-full bg-secondary-500/50')->children([
                        html()->element('progress')->class('progress progress-secondary absolute inset-0 z-10')->attributes([
                            'x-model' => 'bufferedPct(buffered, duration)',
                            ':min' => 0,
                            ':max' => 100,
                            'step' => 'any'
                        ]),

                        html()->element('progress')->class('progress progress-primary absolute inset-0 z-20')->attributes([
                            'x-model' => 'currentTime',
                            ':min' => 0,
                            ':max' => 'duration',
                            'step' => 'any'
                        ]),

                        html()->input('range')->class('range range-primary absolute inset-0 z-30')->attributes([
                            'x-model' => 'currentTime',
                            'x-on:input' => 'seekTo',
                            ':min' => 0,
                            ':max' => 'duration',
                            'step' => 'any'
                        ]),
                    ]),

                    html()->element('nav')->class('h-full w-full flex flex-nowrap items-center justify-between')->children([
                        html()->div()->class('inline-flex w-2/4 items-center justify-start gap-x-1.5')->children([
                            html()->button()->class('btn')->attribute('x-on:click', 'togglePlayback')->children([
                                html()->icon()->svg('heroicon-s-pause', 'size-6')->attributes(['x-cloak', 'x-show' => "state === 'playing'"]),
                                html()->icon()->svg('heroicon-s-play', 'size-6')->attributes(['x-cloak', 'x-show' => "state !== 'playing'"]),
                            ]),

                            html()->p()->class('inline-flex text-sm text-secondary-300 gap-x-0.5')->children([
                                html()->span()->attribute('x-text', 'timeFormat(currentTime)'),
                                html()->span()->text('/'),
                                html()->span()->attribute('x-text', 'timeFormat(duration)'),
                            ]),
                        ]),

                        html()->div()->class('inline-flex w-2/4 items-center justify-end gap-x-3')->children([
                            html()->button()->class('btn')->attribute('x-on:click', 'toggleFullscreen')->children([
                                html()->icon()->svg('heroicon-s-arrows-pointing-in', 'size-6')->attributes(['x-cloak', 'x-show' => 'fullscreen']),
                                html()->icon()->svg('heroicon-s-arrows-pointing-out', 'size-6')->attributes(['x-cloak', 'x-show' => '! fullscreen']),
                            ]),
                        ]),
                    ])
                ])
            ),
        ])
    ])
}}

<x-app.player.ui />

