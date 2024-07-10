{{ html()
    ->element('article')
    ->class('h-14 max-h-14 w-full')
    ->child(html()
        ->a()
        ->route('tags.view', $tag)
        ->forgetAttribute('class')
        ->class('flex flex-nowrap items-center gap-x-3 hover:bg-secondary-500/50')
        ->children([
            html()->icon()->svg('heroicon-s-tag', 'p-2 size-14 bg-gradient-to-tl from-indigo-500 via-purple-500 to-primary-500'),
            html()->div()->class('flex flex-col')->children([
                html()->span($tag->name)->class('text-base'),
                html()->span("{$tag->videos_count} videos")->class('text-sm text-secondary-300'),
            ]),
        ])
    )
}}
