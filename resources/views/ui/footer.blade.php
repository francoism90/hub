{{ html()->element('footer')->class('sticky bottom-0 z-30 h-16 max-h-16 w-full bg-secondary-950 border-t border-secondary-800/80')->children([
    html()->element('nav')->class('*:flex-col *:p-1.5 *:gap-1.5 *:line-clamp *:text-xs *:font-medium container max-w-xl flex h-full justify-between gap-x-3 overflow-x-auto sm:gap-x-12')->children([
        html()->a()->route('home')->text('Home')->prependChildren([
            html()->icon()->svg(request()->routeIs('home') ? 'heroicon-s-square-2-stack' : 'heroicon-o-square-2-stack', 'text-white size-6'),
        ]),

        html()->a()->route('search')->text('Search')->prependChildren([
            html()->icon()->svg(request()->routeIs('search') ? 'heroicon-s-magnifying-glass' : 'heroicon-o-magnifying-glass', 'text-white size-6'),
        ]),

        html()->a()->route('search')->text('Collections')->prependChildren([
            html()->icon()->svg(request()->routeIs('search') ? 'heroicon-s-bookmark' : 'heroicon-o-bookmark', 'text-white size-6'),
        ]),

        html()->a()->route('search')->text('Me')->prependChildren([
            html()->icon()->svg(request()->routeIs('search') ? 'heroicon-s-user' : 'heroicon-o-user', 'text-white size-6'),
        ]),

        html()->a()->route('search')->text('More')->prependChildren([
            html()->icon()->svg(request()->routeIs('search') ? 'heroicon-s-ellipsis-horizontal' : 'heroicon-o-ellipsis-horizontal', 'text-white size-6'),
        ]),
    ])
]) }}
