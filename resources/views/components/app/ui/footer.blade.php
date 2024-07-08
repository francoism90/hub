@php
    $isActive = fn (string $route) => request()->routeIs($route, "{$route}.*");
@endphp

{{ html()->element('footer')->class('sticky bottom-0 z-30 h-16 max-h-16 w-full bg-secondary-950 border-t border-secondary-800/80')->children([
    html()->element('nav')->class('*:flex-col *:gap-1 *:py-0.5 *:text-sm *:font-medium *:line-clamp container h-full max-w-xl flex flex-nowrap items-stretch justify-between gap-x-3 overflow-x-auto sm:gap-x-12')->children([
        html()->a()->route('home')->text('Home')->prependChild(
            html()->icon()->svg($isActive('home') ? 'heroicon-s-square-2-stack' : 'heroicon-o-square-2-stack', 'size-6'),
        ),

        html()->a()->route('search')->text('Search')->prependChild(
            html()->icon()->svg($isActive('search') ? 'heroicon-s-magnifying-glass' : 'heroicon-o-magnifying-glass', 'size-6'),
        ),

        html()->a()->route('profile.history')->text('Collections')->prependChild(
            html()->icon()->svg($isActive('foo') ? 'heroicon-s-bookmark' : 'heroicon-o-bookmark', 'size-6'),
        ),

        html()->a()->route('profile.history')->text('Me')->prependChild(
            html()->icon()->svg($isActive('foo2') ? 'heroicon-s-user' : 'heroicon-o-user', 'size-6'),
        ),

        html()->a()->route('profile.history')->text('More')->prependChild(
            html()->icon()->svg($isActive('foo3') ? 'heroicon-s-ellipsis-horizontal' : 'heroicon-o-ellipsis-horizontal', 'size-6'),
        ),
    ])
]) }}
