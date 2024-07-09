{{ html()->div()->class('absolute bottom-5 inset-x-3 z-20')->child(
    html()->element('nav')->class('h-full w-full flex flex-nowrap items-center justify-between')->children([
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

        html()->div()->class('inline-flex w-2/4 items-center justify-end gap-x-3')->children([
            html()->button()->class('btn')->attribute('x-on:click', 'toggleFullscreen')->children([
                html()->icon()->svg('heroicon-s-arrows-pointing-in', 'size-6')->attributes(['x-cloak', 'x-show' => 'fullscreen']),
                html()->icon()->svg('heroicon-s-arrows-pointing-out', 'size-6')->attributes(['x-cloak', 'x-show' => '! fullscreen']),
            ]),
        ]),
    ])
) }}
