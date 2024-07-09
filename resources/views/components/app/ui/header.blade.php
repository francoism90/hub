{{ html()->element('header')->class('h-14 min-h-14 bg-secondary-950 border-b border-secondary-800/80')->children([
    html()->element('nav')->class('container mx-0 max-w-none h-full flex flex-nowrap items-stretch justify-between gap-x-3 overflow-x-auto sm:gap-x-12')->children([
        html()->div()->class('inline-flex w-2/4 items-center justify-start')->child(
            html()->a()->route('home')->children([
                html()->div()->class('flex flex-nowrap items-center text-primary-100 hover:text-primary-100 gap-x-3')->children([
                    html()->icon()->svg('heroicon-s-play-circle', 'size-8 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-0.5'),
                    html()->span(config('app.name'))->class('text-2xl font-light lowercase')
                ])
            ])
        ),

        html()->div()->class('*:inline-flex *:gap-1 *:py-0.5 *:text-sm *:font-medium *:line-clamp inline-flex w-2/4 items-center justify-end gap-x-3')->children([
            html()->a()->route('search.index')->child(
                html()->icon()->svg('heroicon-o-magnifying-glass', 'size-6 text-inherit'),
            ),

            html()->a()->route('account.notifications')->child(
                html()->icon()->svg('heroicon-o-bell', 'size-6 text-inherit'),
            ),
        ]),
    ])
]) }}
