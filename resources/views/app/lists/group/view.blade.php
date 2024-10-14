@php
    $items = Number::abbreviate($group->videos_count);

    $icon = match ($group->name) {
        'favorites' => 'heroicon-s-heart',
        'history' => 'heroicon-s-eye',
        'watchlist' => 'heroicon-s-clock',
        default => 'heroicon-s-bookmark',
    }
@endphp

{{ html()
    ->element('article')
    ->class('card h-12 min-h-12 max-h-12 w-full')
    ->child(html()
        ->a()
        ->link('lists.view', $group)
        ->forgetAttribute('class')
        ->class('flex flex-nowrap items-center gap-x-3 hover:bg-secondary-500/50')
        ->children([
            html()->icon()->svg($icon, 'p-3 size-12 bg-gradient-to-tl from-indigo-500 via-purple-500 to-primary-500'),
            html()->div()->class('flex flex-col')->children([
                html()->span(str($group->name)->title())->class('text-secondary-100'),
                html()->span("{$items} videos")->class('text-sm text-secondary-300'),
            ]),
        ])
    )
}}
