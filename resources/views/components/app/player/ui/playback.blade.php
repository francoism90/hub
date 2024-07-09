{{ html()->div()->class('absolute bottom-3 inset-x-3 z-20')->child(
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
            // Playback
            html()->div()->class('inline-flex w-2/4 items-center justify-start gap-x-1')->children([
                html()->button()->class('btn')->attribute('x-on:click', 'togglePlayback')->children([
                    html()->icon()->svg('heroicon-s-pause', 'size-6')->attributes(['x-cloak', 'x-show' => 'paused']),
                    html()->icon()->svg('heroicon-s-play', 'size-6')->attributes(['x-cloak', 'x-show' => '! paused']),
                ]),

                html()->p()->class('inline-flex text-sm text-secondary-300 gap-x-0.5')->children([
                    html()->span()->attribute('x-text', 'timeFormat(currentTime)'),
                    html()->span()->text('/'),
                    html()->span()->attribute('x-text', 'timeFormat(duration)'),
                ]),
            ]),

            // Settings
            html()->div()->class('inline-flex w-2/4 items-center justify-end gap-x-3')->children([
                html()->button()->class('btn')->attribute('x-on:click', 'toggleFullscreen')->children([
                    html()->icon()->svg('heroicon-s-arrows-pointing-in', 'size-6')->attributes(['x-cloak', 'x-show' => 'fullscreen']),
                    html()->icon()->svg('heroicon-s-arrows-pointing-out', 'size-6')->attributes(['x-cloak', 'x-show' => '! fullscreen']),
                ]),
            ]),
        ])
    ])
) }}
