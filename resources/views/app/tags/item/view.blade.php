@php
    $items = Number::abbreviate($tag->videos()->count());
@endphp

{{ html()
    ->element('article')
    ->class('card h-12 min-h-12 max-h-12 w-full')
    ->child(html()
        ->a()
        ->link('tags.view', $tag)
        ->forgetAttribute('class')
        ->class('flex flex-nowrap items-center gap-x-3 hover:bg-gray-500/50')
        ->children([
            html()->icon()->svg('heroicon-s-tag', 'p-3 size-12 bg-linear-to-tl from-indigo-500 via-purple-500 to-pink-500'),
            html()->div()->class('flex flex-col')->children([
                html()->span($tag->name)->class('text-gray-100'),
                html()->span("{$items} videos")->class('text-sm text-gray-300'),
            ]),
        ])
    )
}}
