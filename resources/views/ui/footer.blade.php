{{ html()->element('footer')->class('sticky bottom-0 z-30 h-16 max-h-16 w-full bg-secondary-950 border-t border-secondary-800/80')->children([
    html()->div()->class('container flex h-16 justify-between gap-x-3 overflow-x-auto sm:gap-x-12')->children([
        // html()->icon('heroicon-o-square-2-stack', 'text-white size-5')->class('foo'),
        // html()->a()->class('link')->route('home')->text('Home')->prependChild(
        //     html()->icon('heroicon-o-square-2-stack'),
        // ),

        // html()->a()->route('home')->text('Home'),

        // html()->a()->href(route('home'))->text('Home'),

        // html()->a()->href(route('home'))->text('Home'),

        html()->icon()->svg('heroicon-o-square-2-stack', 'text-white size-5'),
    ])
]) }}
