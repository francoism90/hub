{{ html()->div()->class('absolute z-10 inset-0 size-full')->children([
    html()->div()->class('size-full grid grid-cols-2 gap-x-4')->children([
        html()->div()->attribute('x-on:dblclick.debounce', 'backward'),
        html()->div()->attribute('x-on:dblclick.debounce', 'forward'),
    ]),

    // html()->div()->attributes([
    //     'x-cloak',
    //     'x-show' => 'overlay',
    //     'x-transition',
    // ])
])->open() }}
    <x-app.player.ui.seekbar />
    <x-app.player.ui.playback />
{{ html()->div()->close() }}
