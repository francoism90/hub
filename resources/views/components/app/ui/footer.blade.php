@php
    $isActive = fn (string $route) => request()->routeIs($route, "{$route}.*");
@endphp

{{ html()->element('footer')->class('sticky bottom-0 z-30 h-16 min-h-16 w-full bg-secondary-950 border-t border-secondary-800/80')->children([
    html()->element('nav')->class('*:flex *:flex-col *:h-full *:gap-1 *:py-0.5 *:px-3 *:text-sm *:font-medium *:line-clamp container h-full max-w-xl flex flex-nowrap items-stretch justify-between overflow-x-auto')->children([
        html()->a()->link('home', modifiers: 'exact')->text('Home')->prependChild(
            html()->icon()->svg($isActive('home') ? 'heroicon-s-home' : 'heroicon-o-home', 'size-6'),
        ),

        html()->a()->link('account.library', modifiers: 'exact')->text('Library')->prependChild(
            html()->icon()->svg($isActive('account.library') ? 'heroicon-s-rectangle-stack' : 'heroicon-o-rectangle-stack', 'size-6'),
        ),

        html()->a()->link('tags.index', modifiers: 'exact')->text('Tags')->prependChild(
            html()->icon()->svg($isActive('tags') ? 'heroicon-s-bookmark' : 'heroicon-o-bookmark', 'size-6'),
        ),

        html()->a()->link('account.profile', modifiers: 'exact')->text('Me')->prependChild(
            html()->icon()->svg($isActive('account.profile') ? 'heroicon-s-user' : 'heroicon-o-user', 'size-6'),
        ),
    ])
]) }}
