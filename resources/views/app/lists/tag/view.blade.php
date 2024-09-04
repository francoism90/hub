@php
    $items = Number::abbreviate($tag->videos_count);
@endphp

{{ html()
    ->element('article')
    ->class('h-12 min-h-12 max-h-12 w-full')
    ->child(html()
        ->a()
        ->link('tags.view', $tag)
        ->forgetAttribute('class')
        ->class('flex flex-nowrap items-center gap-x-3 hover:bg-secondary-500/50')
        ->children([
            html()->icon()->svg('heroicon-s-tag', 'p-3 size-12 bg-gradient-to-tl from-indigo-500 via-purple-500 to-primary-500'),
            html()->div()->class('flex flex-col')->children([
                html()->span($tag->name)->class('text-secondary-100'),
                html()->span("{$items} videos")->class('text-sm text-secondary-300'),
            ]),
        ])
    )
}}
