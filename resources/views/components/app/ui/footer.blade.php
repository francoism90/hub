@php
    $isActive = fn (string $route) => request()->routeIs($route, "{$route}.*");
@endphp

{{ html()->element('footer')->class('sticky bottom-0 z-30 h-16 min-h-16 w-full bg-secondary-950 border-t border-secondary-800/80')->children([
    html()->element('nav')->class('*:flex-col *:gap-1 *:py-0.5 *:px-3 *:text-sm *:font-medium *:line-clamp container h-full max-w-xl flex flex-nowrap items-stretch justify-between overflow-x-auto')->children([
        html()->a()->route('home')->text('Home')->prependChild(
            html()->icon()->svg($isActive('home') ? 'heroicon-s-home' : 'heroicon-o-home', 'size-6'),
        ),

        html()->a()->route('lists.index')->text('Playlists')->prependChild(
            html()->icon()->svg($isActive('lists') ? 'heroicon-s-bookmark' : 'heroicon-o-bookmark', 'size-6'),
        ),

        html()->a()->route('library.index')->text('Library')->prependChild(
            html()->icon()->svg($isActive('library') ? 'heroicon-s-rectangle-stack' : 'heroicon-o-rectangle-stack', 'size-6'),
        ),

        html()->a()->route('account.notifications')->text('Me')->prependChild(
            html()->icon()->svg($isActive('account') ? 'heroicon-s-user' : 'heroicon-o-user', 'size-6'),
        ),
    ])
]) }}
